@extends('layoutes.app')
@section('title', $title)

@section('content')
<div class="col-md-offset-2 col-md-8">
    <h1>{{ $title }}</h1>
    <ul class="users">
        @foreach($users as $user)
            <li>
                <a href="{{ route('users.show', $user->id) }}" class="username">
                    <img src="{{ $user->getAvatar() }}" alt="{{ $user->name }}">{{ $user->name }}
                </a>
            </li>
        @endforeach
    </ul>

    {!! $users->render() !!}
</div>
@endsection