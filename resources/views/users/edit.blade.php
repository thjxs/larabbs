@extends('layouts.app')

@section('content')
<div class="container">
    <div class="panel panel-default col-md-10 col-md-offset-1">
        <div class="panel-heading">
            <h4><i class="glyphicon glyphicon-edit">Edit</i></h4>
        </div>

        <div class="panel-body">
            <form action="{{ route('users.update', $user->id) }}" method="post" accept-charset="UTF-8">
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
                    <textarea name="introduction" id="introduction" class="form-control" rows="3">
                        {{ old('introduction', $user->introduction) }}
                    </textarea>
                </div>

                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection