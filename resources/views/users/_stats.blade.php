<div class="stats">
    <a href="{{ route('users.show_followings', $user->id) }}">
        <strong id="following" class="stats">
            {{ count($user->followings) }}
        </strong>
        Follow
    </a>
    <a href="{{ route('users.show_followers', $user->id) }}">
        <strong id="followers" class="stats">
            {{ count($user->followers) }}
        </strong>
        Fan
    </a>
    <a href="{{ route('users.show', $user->id) }}">
        <strong id="topics" class="stats">
            {{ $user->topics()->count() }}
        </strong>
        Topic
    </a>
</div>