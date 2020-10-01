@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.adderTitle') }}</h2>
    <form class="form-row" action="{{ route('task.store') }}" method="POST">
        @csrf
        <div class="form-group col-md-6">
            <label for="name">{{ __('task.name') }}</label>
            <input class="form-control" id="name" name="name" type="text">
        </div>
        <div class="form-group col-md-6">
            <label for="description">{{ __('task.description') }}</label>
            <input class="form-control" id="description" name="description" type="text">
        </div>
        <div class="form-group col-md-6">
            <label for="asignee">{{ __('task.asignee') }}</label>
            <select class="form-control" name="assignee" id="assignee">
                @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="status">{{ __('task.status') }}</label>
            <select class="form-control" id="status" name="status">
                @foreach($statuses as $status)
                <option value="{{ $status->id }}">{{ $status->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="label">{{ __('task.label') }}</label>
            <select class="chosen-select" id="label" name="label[]" multiple>
                @foreach($labels as $label)
                <option value="{{ $label->id }}">{{ $label->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">{{ __('task.save') }}</button>
        </div>
    </form>
</div>
@endsection
