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
            <select class="form-control" name="assignee" id="assignee">
                @foreach($assigners as $assigner)
                <option value="{{ $assigner->id }}" @if($assigner->id == $task->assigned_to_id) selected @endif>{{ $assigner->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="status">{{ __('task.status') }}</label>
            <select class="form-control mr-2" id="status" name="status">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if($status->id == $task->status_id) selected @endif>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="label">{{ __('task.label') }}</label>
            <select class="chosen-select" id="label" name="label[]" multiple>
                @foreach($labels as $label)
                @foreach($task->labels as $taskLabel)
                <option value="{{ $label->id }}" @if($label->id == $taskLabel->id) selected @endif>{{ $label->name }}</option>
                @endforeach
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">{{ __('task.save') }}</button>
        </div>
    </form>
</div>
@endsection
