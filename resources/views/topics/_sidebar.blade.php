<div class="panel pane-default">
    <div class="panel-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="glyphicon glyphicon-pencil" araa-hidden="true"></span> New Topic
        </a>
    </div>
</div>

@if ($active_users)
<div class="panel pane-default">
    <div class="panel-body active-users">
        <div class="text-center">active user</div>
        <hr>
        @foreach ($active_users as $active_user)
            <a href="{{ route('users.show', $active_user->id) }}" class="media">
                <div class="media-left media-middle">
                    <img src="{{ $active_user->getAvatar() }}" width="24px" height="24px" class="img-circle media-object">
                </div>
                <div class="media-body">
                    <span class="media-heading">{{ $active_user->name }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endif