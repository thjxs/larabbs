@if (count($topics))
<ul class="list-group">
    @foreach ($topics as $topic)
        <li class="list-group-item">
            <a href="{{ route('topics.show', $topic->id) }}">
                {{ $topic->title }}
            </a>
            <span class="meta pull-right">
                {{ $topic->reply_count }} Reply
                <span> ~ </span>
                {{ $topic->created_at->diffForHumans() }}
            </span>
        </li>
    @endforeach
</ul>
@else
<div class="empty-block">Empty</div>
@endif

{{-- Render --}}
{!! $topics->render() !!}