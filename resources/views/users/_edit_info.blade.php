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

    <div class="well well-sm">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>