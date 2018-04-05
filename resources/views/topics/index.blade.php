@extends('layouts.app')

@section('title', 'Topic')

@section('content')
<div class="row">
    <div class="col-md-9 col-lg-9 topic-list">
        @if (isset($category))
            <div class="alert alert-info" role="alert">
                {{ $category->name }} : {{ $category->description }}
            </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li role="presentation" class="{{ active_class(!if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=default">Last Reply</a></li>
                    <li role="presentation" class="{{ active_class(if_query('order', 'recent')) }}"><a href="{{ Request::url() }}?order=recent">Recent</a></li>
                </ul>
            </div>

            <div class="panel-body">

                {{-- List --}}
                @include('topics._topic_list', ['topics' => $topics])
                {{-- render --}}
                {!! $topics->render() !!}

            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 sidebar">
        @include('topics._sidebar')
    </div>
</div>

@endsection