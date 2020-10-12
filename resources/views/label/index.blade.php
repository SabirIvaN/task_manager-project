@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('label.mainTitle') }}</h2>
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('label.create') }}">{{ __('label.add') }}</a>
        </div>
    </div>
    @if($labels->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('label.id') }}</th>
                <th scope="col">{{ __('label.name') }}</th>
                <th scope="col" colspan="3">{{ __('label.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
            <tr>
                <th scope="row">{{ $label->id }}</th>
                <td>{{ $label->name }}</td>
                <td>{{ $label->created_at }}</td>
                <td>
                    <a class="btn btn-primary" href="{{ route('label.edit', $label->id) }}">{{ __('label.edit') }}</a>
                </td>
                <td>
                {{ Form::open(['url' => route('label.destroy', $label->id), 'method' => 'delete']) }}
                {{ Form::submit(__('label.delete'), ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
