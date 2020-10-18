@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-1">
        <h2>{{ $task->name }}</h2>
    </div>
    <table class="table">
        <tr>
            <th scope="row">{{ __('task.id') }}</th>
            <td>{{ $task->id }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('task.name') }}</th>
            <td>{{ $task->name }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('task.description') }}</th>
            <td>{{ $task->description }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('task.label') }}</th>
            <td>
                @foreach($task->labels as $label)
                {{ $label->name }} <br>
                @endforeach
            </td>
        </tr>
        <tr>
            <th scope="row">{{ __('task.creator') }}</th>
            <td>{{ $task->creator }}</td>
        </tr>
        <tr>
            <th scope="row">{{ __('task.assignee') }}</th>
            <td>{{ $task->assignee }}</td>
        </tr>
    </table>
</div>
@endsection
