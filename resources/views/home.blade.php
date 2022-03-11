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
                                <a href="">
                                    <div class="chat-image">
                                        {!! makeImageFromName($user->name) !!}
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
        <div class="col-md-9"></div>
    </div>
@endsection
