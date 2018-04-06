@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-heading">
                <h1>
                    <i class="glyphicon glyphicon-edit"></i> Topic /
                    @if($topic->id)
                        Edit #{{$topic->id}}
                    @else
                        Create
                    @endif
                </h1>
            </div>

            @include('common.error')

            <div class="panel-body">
                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">


                    <div class="form-group">
                    	<label for="title-field">Title</label>
                    	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" />
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id" required>
                            <option value="" hidden disabled selected>Category</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                    	<label for="body-field">Body</label>
                    	<textarea name="body" id="body-field" class="form-control" rows="3">{{ old('body', $topic->body ) }}</textarea>
                    </div>
                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a class="btn btn-link pull-right" href="{{ route('topics.index') }}"><i class="glyphicon glyphicon-backward"></i>  Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection