@foreach(['message', 'success', 'danger'] as $msg)
    @if(session()->has($msg))
        <div class="alert alert-info">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{ session()->get($msg) }}
        </div>
    @endif
@endforeach