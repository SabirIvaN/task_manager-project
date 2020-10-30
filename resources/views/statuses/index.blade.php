@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('status.mainTitle') }}</h2>

        @auth
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('statuses.create') }}">{{ __('status.add') }}</a>
        </div>
        @endauth
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
                @auth
                <td>
                    <a class="btn btn-primary" href="{{ route('statuses.edit', $status) }}">{{ __('status.edit') }}</a>
                </td>
                <td>
                    @can('delete', $status)
                    <a class="btn btn-danger" href="{{ route('statuses.destroy', $status) }}" data-confirm="{{__('status.confirm')}}" data-method="delete" rel="nofollow">{{__('status.delete')}}</a>
                    @endcan
                </td>
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
