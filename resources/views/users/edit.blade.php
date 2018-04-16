@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="{{ route('users.edit', Auth::id()) }}"><div class="media-body">Edit</div></a>
                <a href="{{ route('users.edit_avatar', Auth::id()) }}"><div class="media-body">Edit_avatar</div></a>
                <a href="#"><div class="media-body">Edit</div></a>
                <a href="#"><div class="media-body">Edit</div></a>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-md-9 col-sm-12 col-xs-12 panel panel-default">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-edit">Edit</i></h4>
        </div>

        <div class="panel-body">
            @switch($i)
                @case(1)
                    @include('users._edit_info')
                    @break
                @case(2)
                    @include('users._edit_avatar')
                    @break
                @default
                    @include('users._edit_info')
            @endswitch
        </div>
    </div>
</div>
@endsection