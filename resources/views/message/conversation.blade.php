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
            <div class="chat-body">

            </div>
        </div>
    </div>
@endsection
