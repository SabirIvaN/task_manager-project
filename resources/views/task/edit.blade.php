@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.editorTitle') }}</h2>
    {{ Form::model($task, ['url' => route('task.update', $task->id), 'class' => 'form-row']) }}
    @method('PUT')
    @csrf
    <div class="form-group col-md-6">
        {{ Form::label('name', __('task.name')) }}
        {{ Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'value' => $task->name]) }}
        @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('description', __('task.description')) }}
        {{ Form::text('description', null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'value' => $task->description]) }}
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('assigned_to_id', __('task.assignee')) }}
        {{ Form::select('assigned_to_id', $users->mapWithKeys(function ($user) {
            return [$user->id => $user->name];
        }), null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('status_id', __('task.status')) }}
        {{ Form::select('status_id', $statuses->mapWithKeys(function ($status) {
            return [$status->id => $status->name];
        }), null, ['class' => 'form-control']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('label_id', __('task.label')) }}
        {{ Form::select('label_id[]', $labels->mapWithKeys(function ($label) {
            return [$label->id => $label->name];
        }), $task->labels, ['class' => 'chosen-select', 'multiple' => true]) }}
    </div>
    <div class="form-group col-md-12">
        {{ Form::submit(__('task.save'), ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection
