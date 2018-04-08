@extends('layouts.app')
@section('title', 'permission denied')

@section('content')
<div class="col-md-4 col-md-offset-4">
    <div class="panel panel-default">
        <div class="panel-body">
            @if (Auth::check())
                <div class="alert alert-danger text-center">
                    Permission Denied
                </div>
            @else
                <div class="alert alert-danger text-center">
                    Please Login
                </div>
                <a href="{{ route('login') }}" class="btn btn-lg btn-primary btn-block">
                    <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span>
                    Login
                </a>
            @endif
        </div>
    </div>
</div>
@endsection