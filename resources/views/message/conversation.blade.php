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
                                <a href="">
                                    <div class="chat-image">
                                        {!! makeImageFromName($user->name) !!}
                                        <i class="fa fa-circle user-status-icon" title="away" aria-hidden="true"></i>
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
