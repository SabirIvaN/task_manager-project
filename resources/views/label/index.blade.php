@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('label.mainTitle') }}</h2>

        @auth
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('label.create') }}">{{ __('label.add') }}</a>
        </div>
        @endauth
    </div>
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
                @auth
                <td>
                    <a class="btn btn-primary" href="{{ route('label.edit', $label) }}">{{ __('label.edit') }}</a>
                </td>
                @can('delete', $label)
                <td>
                    <a class="btn btn-danger" href="{{ route('label.destroy', $label) }}" data-confirm="{{__('label.confirm')}}" data-method="delete" rel="nofollow">{{__('label.delete')}}</a>
                </td>
                @endcan
                @endauth
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
