@extends('layouts.app')

@section('content')
    <div class="row chat-row">
        <div class="col-md-3">
            <div class="users">
                <h5>Users</h5>
                <ul class="list-group list-chat-item">
                    @if($users->count())
                        @foreach($users as $user)
                            <li class="chat-user-list">
                                <a href="{{ route('message.conversation' , $user->id) }}">
                                    <div class="chat-image">
                                        {!! makeImageFromName($user->name) !!}
                                        <i class="fa fa-circle user-status-icon" title="away" aria-hidden="true"></i>
                                    </div>
                                    <span class="chat-name">
                                        {{$user->name}}
                                    </span>
                                </a>
                            </li>
                        @endforeach

                    @endif

                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <h1>Message Section</h1>

            <p>Select User From List</p>
        </div>
    </div>
@endsection
