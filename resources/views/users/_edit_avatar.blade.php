<form action="{{ route('users.update_avatar', $user->id) }}" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="PUT">
    {{ csrf_field() }}
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