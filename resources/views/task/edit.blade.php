@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.editorTitle') }}</h2>
    <form class="form-row" action="{{ route('task.update', $task->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group col-md-6">
            <label for="name">{{ __('task.name') }}</label>
            <input class="form-control mr-2" id="name" name="name" type="text" value="{{ $task->name }}">
        </div>
        <div class="form-group col-md-6">
            <label for="description">{{ __('task.description') }}</label>
            <input class="form-control" type="text" name="description" id="description" value="{{ $task->description }}">
        </div>
        <div class="form-group col-md-6">
            <label for="asignee">{{ __('task.asignee') }}</label>
            <select class="form-control" name="asignee" id="asignee">
                @foreach($users as $user)
                <option value="{{ $user->id }}" @if($user->id == $task->creator->id) selected @endif>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="status">{{ __('task.status') }}</label>
            <select class="form-control mr-2" id="status" name="status">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if($user->id == $task->status->id) selected @endif>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <button class="btn btn-primary" type="submit">{{ __('task.save') }}</button>
        </div>
    </form>
</div>
@endsection
