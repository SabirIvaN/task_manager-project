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
            <select class="form-control" name="assigned_to_id" id="assigned_to_id">
                @foreach($assigners as $assigner)
                <option value="{{ $assigner->id }}" @if($assigner->id == $task->assigned_to_id) selected @endif>{{ $assigner->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="status">{{ __('task.status') }}</label>
            <select class="form-control mr-2" id="status_id" name="status_id">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}" @if($status->id == $task->status_id) selected @endif>{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="label">{{ __('task.label') }}</label>
            <select class="chosen-select" id="label_id" name="label_id[]" multiple>
                @foreach($labels as $key => $label)
                <option value="{{ $label->id }}"
                @foreach($task->labels as $labelTask)
                @if($label->id === $labelTask->id) selected @endif
                @endforeach
                >{{ $label->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">{{ __('task.save') }}</button>
        </div>
    </form>
</div>
@endsection
