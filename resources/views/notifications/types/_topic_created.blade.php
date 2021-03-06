<div class="media">
    <div class="avatar pull-left">
        <a href="{{ route('users.show', $notification->data['user_id']) }}">
            <img class="media-object img-thumbnail" alt="{{ $notification->data['user_name'] }}" src="{{ $notification->data['user_avatar'] }}" style="width: 48px;height: 48px;">
        </a>
    </div>

    <div class="infos">
        <div class="media-heading">
            <a href="{{ route('users.show', $notification->data['user_id']) }}">{{ $notification->data['user_name'] }}</a>
            Post:
            <a href="{{ $notification->data['topic_link'] }}">{{ $notification->data['topic_title'] }}</a>

            {{-- reply delete button --}}
            <span class="meta pull-right" title="{{ $notification->created_at }}">
                <span class="glyphicon glyphicon-clock" aria-hidden="true"></span>
                {{ $notification->created_at->diffForHumans() }}
            </span>
        </div>

        <div class="reply-content">
            {!! $notification->data['topic_body'] !!}
        </div>
    </div>
</div>
<hr>