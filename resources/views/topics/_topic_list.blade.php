@if (count($topics))
<ul class="media-list">
    @foreach ($topics as $topic)
        <li class="media">
            <div class="media-left">
                <a href="{{ route('users.show', [$topic->user_id]) }}">
                    <img src="{{ $topic->user->avatar() }}" title="{{ $topic->user->name }}" style="width: 52px;height: 52px;" class="media-object img-thumbnail">
                </a>
            </div>

            <div class="media-body">
                <div class="media-heading">
                    <a href="{{ $topic->link() }}" title="{{ $topic->title }}">
                        {{ $topic->title }}
                    </a>
                    <a href="{{ $topic->link() }}" class="pull-right">
                        <span class="badge">{{ $topic->reply_count }}</span>
                    </a>
                </div>

                <div class="media-body meta">
                    <a href="{{ route('categories.show', $topic->category->id) }}" title="{{ $topic->category->name }}">
                        <span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span>
                        {{ $topic->category->name }}
                    </a>
                    <span> ~ </span>
                    <a href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        {{ $topic->user->name }}
                    </a>
                    <span> ~ </span>
                    <span class="timego" title="Latest">{{ $topic->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </li>
        @if (!$loop->last)
            <hr>
        @endif

    @endforeach
</ul>
@else
    <div class="empty-block">Empty</div>
@endif