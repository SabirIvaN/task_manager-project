@extends('layouts.app')

@section('content')
<div class="container">
    @include("flash::message")
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-1">
        <h2>{{ __('task.mainTitle') }}</h2>
        @if(confirmation())
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('task.create') }}">{{ __('task.add') }}</a>
        </div>
        @endif
    </div>
    <form class="form-row" action="{{ route('task.index') }}" method="GET">
        <div class="form-group col-md-2">
            <select class="form-control" name="filter[status_id]" id="filterStatuses">
                <option value="all_statuses">All statuses</option>
                @foreach($filters as $filter)
                @if(isset($filter->status_id))
                <option value="{{ $filter->status_id }}" @if(isset($request)) @if($filter->status_id == $request['status_id']) selected @endif @endif>{{ $filter->status->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="filter[created_by_id]" id="filterCreators">
                <option value="all_creators">All creators</option>
                @foreach($filters as $filter)
                @if(isset($filter->created_by_id))
                <option value="{{ $filter->created_by_id }}" @if(isset($request)) @if($filter->created_by_id == $request['created_by_id']) selected @endif @endif>{{ $filter->creator->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-2">
            <select class="form-control" name="filter[assigned_to_id]" id="filterAssigner">
                <option value="all_assigners">All assigner</option>
                @foreach($filters as $filter)
                @if(isset($filter->assigned_to_id))
                <option value="{{ $filter->assigned_to_id }}" @if(isset($request)) @if($filter->assigned_to_id == $request['assigned_to_id']) selected @endif @endif>{{ $filter->assigner->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-1">
            <button class="btn btn-primary" type="submit">Apply</button>
        </div>
    </form>
    @if($tasks->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('task.id') }}</th>
                <th scope="col">{{ __('task.name') }}</th>
                <th scope="col">{{ __('task.description') }}</th>
                <th scope="col">{{ __('task.status') }}</th>
                <th scope="col">{{ __('task.label') }}</th>
                <th scope="col">{{ __('task.creator') }}</th>
                <th scope="col">{{ __('task.asignee') }}</th>
                <th scope="col" @if(confirmation()) colspan="3" @endif>{{ __('task.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->description }}</td>
                <td>
                @if(isset($task->status->name))
                {{ $task->status->name }}
                @endif
                </td>
                <td>
                @foreach($task->labels as $label)
                {{ $label->name .  " "}}
                @endforeach
                </td>
                <td>
                @if(isset($task->creator->name))
                {{ $task->creator->name }}
                @endif
                </td>
                <td>
                @if(isset($task->assigner->name))
                {{ $task->assigner->name }}
                @endif
                </td>
                <td>{{ $task->created_at }}</td>
                @if(Auth::user())
                @if(Auth::user()->hasVerifiedEmail())
                <td>
                    <a class="btn btn-primary" href="{{ route('task.edit', $task->id) }}">{{ __('task.edit') }}</a>
                </td>
                <td>
                    <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">{{ __('task.delete') }}</button>
                    </form>
                </td>
                @endif
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
