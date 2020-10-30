@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-1">
        <h2>{{ $task->name }}</h2>
    </div>
    <table class="table">
        <tr>
            <th scope="row">{{ __('tasks.id') }}</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('tasks.name') }}</th>
            <td>{{ $task->name }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('tasks.description') }}</th>
            <td>{{ $task->description }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('tasks.label') }}</th>
            <td>
                @foreach($task->labels as $label)
                {{ $label->name }} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th scope="row">{{ __('tasks.creator') }}</th>
            <td>{{ $task->createdBy->name }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('tasks.assignee') }}</th>
            <td>{{ optional($task->assignedTo)->name }}</td>
        </tr>
    </table>
</div>
@endsection
