@extends('layouts.app')

@section('title', $user->name . "'s center");

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div align="center">
                        <img src="{{ $user->getAvatar(300) }}" class="thumbnail img-responsive" width="300px" height="300px">
                    </div>

                    <div class="media-body">
                        <hr>
                        <h4><strong>Profile</strong></h4>
                        <p>{{ $user->introduction }}</p>
                        <hr>
                        <h4><strong>Created_at</strong></h4>
                        <p>{{ $user->created_at->diffForHumans() }}</p>
                        <hr>
                        <h4><strong>Last actived_at</strong></h4>
                        <p>{{ $user->last_actived_at->diffForHumans() }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <span class="panel-title pull-left">{{ $user->name }}</span>
            </div>
        </div>
        <hr>
        {{-- content --}}
        <div class="panel panel-default">
            <div class="panel-body">
                <ul class="nav nav-tabs">
                    <li class="{{ active_class(if_query('tab', null)) }}"><a href="{{ route('users.show', $user->id) }}">Topic</a></li>
                    <li class="{{ active_class(if_query('tab', 'replies')) }}"><a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">Reply</a></li>
                </ul>
                @if (if_query('tab', 'replies'))
                    @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
                @else
                    @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
                @endif
            </div>
        </div>
    </div>
</div>
@endsection