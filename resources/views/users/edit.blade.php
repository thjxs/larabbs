@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
        <div class="panel panel-default">
            <div class="panel-body">
                <a href="#"><div class="media-body">Edit</div></a>
                <a href="#"><div class="media-body">Edit_avatar</div></a>
                <a href="#"><div class="media-body">Edit</div></a>
                <a href="#"><div class="media-body">Edit</div></a>
            </div>
        </div>
    </div>
    <div class="col-md-9 col-md-9 col-sm-12 col-xs-12">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-edit">Edit</i></h4>
        </div>

        <div class="panel-body">
            <form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="name">User Name</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name', $user->name) }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email', $user->email) }}">
                </div>

                <div class="form-group">
                    <label for="introduction">Profile</label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="3">{{ old('introduction', $user->introduction) }}</textarea>
                </div>

                <div class="form-group">
                    <label class="avatar">Avatar</label>
                    <input type="file" name="avatar">
                    @if($user->avatar)
                        <br>
                        <img src="{{ $user->avatar }}" class="thumbnail img-responsive" width="200px">
                    @endif
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection