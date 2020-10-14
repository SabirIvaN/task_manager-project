@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('status.mainTitle') }}</h2>

        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('status.create') }}">{{ __('status.add') }}</a>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('status.id') }}</th>
                <th scope="col">{{ __('status.name') }}</th>
                <th scope="col" colspan="3">{{ __('status.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr>
                <th scope="row">{{ $status->id }}</th>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('status.edit', $status->id) }}">{{ __('status.edit') }}</a>
                </td>
                <td>
                    {{ Form::open(['url' => route('status.destroy', $status->id), 'method' => 'delete', 'class' => 'delete']) }}

                    {{ Form::submit(__('status.delete'), ['class' => 'btn btn-danger']) }}

                    {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
