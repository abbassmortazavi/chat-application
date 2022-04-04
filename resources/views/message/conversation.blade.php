@extends('layouts.app')

@section('content')
    <div class="row chat-row">
        <div class="col-md-3">
            <div class="users">
                <h5>Users</h5>
                <ul class="list-group list-chat-item">
                    @if($users->count())
                        @foreach($users as $user)
                            <li class="chat-user-list {{ $user->id == $friendInfo->id ? 'active': '' }}">
                                <a href="{{ route('message.conversation' , $user->id) }}">
                                    <div class="chat-image">
                                        {!! makeImageFromName($user->name) !!}
                                        <i class="fa fa-circle user-status-icon user-icon-{{ $user->id }}" title="away" aria-hidden="true"></i>
                                    </div>
                                    <div class="chat-name font-weight-bold">
                                        {{$user->name}}
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    @endif

                </ul>
            </div>
        </div>
        <div class="col-md-9 chat-section">
            <h1>Chat Body</h1>
            <div class="chat-header">
                <div class="chat-image">
                    {!! makeImageFromName($user->name) !!}
                </div>
                <div class="chat-name font-weight-bold">
                    {{$user->name}}
                    <i class="fa fa-circle user-status-head" title="away" aria-hidden="true" id="userStatusHead{{$friendInfo->id}}"></i>
                </div>
            </div>
            <div class="chat-body" id="chatBody">
                <div class="message-listing" id="messageWrapper">
                    <div class="row message align-items-center mb-2">
                        <div class="col-md-12 user-info">
                            <div class="chat-image">
                                {!! makeImageFromName('Jafar Mortazavi') !!}
                            </div>
                            <div class="chat-name font-weight-bold">
                                Jafar Mortazavi
                                <span class="small time text-secondary" title="2021">
                                    15:29
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12 message-content">
                            <div class="message-text">
                                Message Here
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-box">
                <div class="chat-input bg-white" id="chatInput" contenteditable="">

                </div>
                <div class="chat-input-toolbar">
                    <button title="Add File" class="btn btn-light btn-sm btn-file-upload">
                        <i class="fa fa-paperclip"></i>
                    </button>
                    <button title="Bold" class="btn btn-light btn-sm tool-items"
                            onclick="document.execCommand('bold' , false , '')">
                        <i class="fa fa-bold tool-icon"></i>
                    </button>
                    <button title="Italic" class="btn btn-light btn-sm btn-file-upload"
                            onclick="document.execCommand('italic' , false , '')">
                        <i class="fa fa-italic"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function (){
            let chatInput = $('.chat-input');
            let chatInputToolbar = $('.chat-input-toolbar');
            let chatBody = $('.chat-body');


            let user_id = "{{ auth()->user()->id }}";
            let ip_address = '127.0.0.1';
            let socket_port = '3000';
            let socket = io(ip_address + ':' + socket_port);
            let friendId = "{{ $friendInfo->id }}";


            socket.on('connect', function ( ){
                socket.emit('user_connected' , user_id);
            });

            socket.on('updateUserStatus' , (data)=>{
                console.log(data);
                let userStatusIcon = $(".user-status-icon");
                userStatusIcon.removeClass('text-success')
                userStatusIcon.attr('title' , 'away ');


                $.each(data , function (key , val){
                    if (val !== null && val !== 0)
                    {
                        console.log(key);
                        let userIcon = $(".user-icon-"+key);
                        userIcon.addClass('text-success')
                        userIcon.attr('title' , 'online ');
                    }
                });
            });
            chatInput.keypress(function (e){
                let message = $(this).html();
                if (e.which === 13 && !e.shiftKey)
                {
                    chatInput.html("");
                    sendMessage(message);
                    return false;
                }

            });
            function sendMessage(message){
                let url = "{{ route('message.send-message') }}";
                let form = $(this);
                let formData = new FormData();
                let token = "{{ csrf_token() }}";

                formData.append('message' , message);
                formData.append('_token' , token);
                formData.append('receiver_id' , friendId);

                $.ajax({
                    url: url,
                    type: "POST",
                    data:formData,
                    processData: false,
                    contentType: false,
                    dataType: 'JSON',
                    success: function (response) {
                        if (response.success){
                            console.log(response.data);
                        }
                    }
                });
            }
        });
    </script>
@endsection
