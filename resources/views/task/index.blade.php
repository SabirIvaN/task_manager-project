@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('task.mainTitle') }}</h2>
        @if(Auth::user())
        @if(Auth::user()->hasVerifiedEmail())
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('task.create') }}">{{ __('task.add') }}</a>
        </div>
        @endif
        @endif
    </div>
    @if($tasks->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('task.id') }}</th>
                <th scope="col">{{ __('task.name') }}</th>
                <th scope="col">{{ __('task.creator') }}</th>
                <th scope="col">{{ __('task.asignee') }}</th>
                <th scope="col" @if(Auth::user()) @if(Auth::user()->hasVerifiedEmail()) colspan="3" @endif @endif>{{ __('task.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tasks as $task)
            <tr>
                <th scope="row">{{ $task->id }}</th>
                <td>{{ $task->name }}</td>
                <td>{{ $task->creator->name }}</td>
                <td>{{ $task->assigner->name }}</td>
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
