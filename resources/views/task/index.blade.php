@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-1">
        <h2>{{ __('task.mainTitle') }}</h2>

        @auth
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('tasks.create') }}">{{ __('task.add') }}</a>
        </div>
        @endauth
    </div>

    {{ Form::open(['url' => route('tasks.index'), 'method' => 'GET', 'class' => 'form-row']) }}

    <div class="form-group col-md-2">
        {{ Form::select('filter[status_id]', $statuses, $currentStatus, ['class' => 'form-control', 'placeholder' => __('task.statuses')])  }}
    </div>

    <div class="form-group col-md-2">
        {{ Form::select('filter[created_by_id]', $creators, $currentCreator, ['class' => 'form-control', 'placeholder' => __('task.creators')])  }}
    </div>

    <div class="form-group col-md-2">
        {{ Form::select('filter[assigned_to_id]', $assigners, $currentAssigner, ['class' => 'form-control', 'placeholder' => __('task.assigners')])  }}
    </div>

    <div class="form-group col-md-1">
        {{ Form::submit(__('task.apply'), ['class' => 'btn btn-primary']) }}
    </div>

    {{ Form::close() }}

    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('task.id') }}</th>
                <th scope="col">{{ __('task.name') }}</th>
                <th scope="col">{{ __('task.description') }}</th>
                <th scope="col">{{ __('task.status') }}</th>
                <th scope="col">{{ __('task.label') }}</th>
                <th scope="col">{{ __('task.creator') }}</th>
                <th scope="col">{{ __('task.assignee') }}</th>
                <th scope="col" colspan="4">{{ __('task.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ optional($task->status)->name }}</td>
                <td>
                    @foreach($task->labels as $label)
                    {{ $label->name }}
                    @endforeach
                </td>
                <td>{{ optional($task->createdBy)->name }}</td>
                <td>{{ optional($task->assignedTo)->name }}</td>
                <td>{{ $task->created_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('tasks.show', $task) }}">{{ __('task.show') }}</a>
                </td>
                @auth
                <td>
                    @can('update', $task)
                    <a class="btn btn-primary" href="{{ route('tasks.edit', $task) }}">{{ __('task.edit') }}</a>
                    @endcan
                </td>
                <td>
                    @can('delete', $task)
                    <a class="btn btn-danger" href="{{ route('tasks.destroy', $task) }}" data-confirm="{{__('task.confirm')}}" data-method="delete" rel="nofollow">{{__('task.delete')}}</a>
                    @endcan
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
