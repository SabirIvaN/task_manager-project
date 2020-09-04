@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.editorTitle') }}</h2>
    <form class="form-row" action="{{ route('task.update', $task->id) }}">
        @method('PUT')
        @csrf
        <div class="form-group col-md-6">
            <label for="name">{{ __('task.name') }}</label>
            <input class="form-control mr-2" id="name" type="text" value="{{ $task->name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="asignee">{{ __('task.asignee') }}</label>
            <select class="form-control" name="asignee" id="asignee">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="status">{{ __('task.status') }}</label>
            <select class="form-control mr-2" id="status" name="status">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <label for="description">{{ __('task.description') }}</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group col-md-6">
            <button class="btn btn-primary" type="submit">{{ __('task.save') }}</button>
        </div>
    </form>
</div>
@endsection
