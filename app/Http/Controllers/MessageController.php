<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
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
}
