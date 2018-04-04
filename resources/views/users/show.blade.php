@extends('layouts.app')

@section('title', $user->name . "'s center");

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="media">
                    <div align="center">
                        <img src="$user->gravatar()" class="thumbnail img-responsive" width="300px" height="300px">
                    </div>

                    <div class="media-body">
                        <hr>
                        <h4><strong>Profile</strong></h4>
                        <hr>
                        <h4><strong>Created_at</strong></h4>

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
        {{ content }}
        <div class="panel panel-default">
            <div class="panel-body">
                h3llo
            </div>
        </div>
    </div>
</div>
@endsection