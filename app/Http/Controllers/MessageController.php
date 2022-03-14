<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    protected $message;
    public function __construct(Message $message)
    {
        $this->message = $message;
    }
    /**
     * @param $userId
     * @return Application|Factory|View
     */
    public function conversation($userId)
    {
        $users = User::where('id' , '!=' , Auth::id())->get();
        $friendInfo = User::findOrFail($userId);
        $myInfo = User::find(Auth::id());
        $this->data['users']= $users;
        $this->data['friendInfo']= $friendInfo;
        $this->data['myInfo']= $myInfo;
        $this->data['userId']= $userId;
        return view('message.conversation' , $this->data);

    }
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message'=>'required',
            'receiver_id'=>'required'
        ]);

        $sender_id = Auth::id();
        $receiver_id = $request->receiver_id;
        $this->message->message = $request->message;

        if ($this->message->save())
        {
            try {
                $this->message->users()->attach($sender_id , ['receiver_id']);
                $sender = User::where('id' , '=' , $sender_id)->first();
                $data = [];
                $data['sender_id'] = $sender_id;
                $data['sender_name'] = $sender->name;
                $data['receiver_id'] = $sender_id;
                $data['content'] = $this->message->message;
                $data['created_at'] = $this->message->created_at;
                $data['message_id'] = $this->message->id;

                return response()->json([
                    'data'=>$data,
                    'success'=>true,
                    'message'=>'Message SuccessFully Sent'
                ]);
            }catch (\Exception $exception){
                    $this->message->delete();
            }
        }
    }
}
