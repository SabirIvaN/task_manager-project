@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('status.mainTitle') }}</h2>
        @if(Auth::user())
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('status.create') }}">{{ __('status.add') }}</a>
        </div>
        @endif
    </div>
    @if($statuses->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('status.id') }}</th>
                <th scope="col">{{ __('status.name') }}</th>
                <th scope="col" @if(Auth::user()) colspan="3" @endif>{{ __('status.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
            <tr>
                <th scope="row">{{ $status->id }}</th>
                <td>{{ $status->name }}</td>
                <td>{{ $status->created_at }}</td>
                @if(Auth::user())
                <td>
                    <a class="btn btn-primary" href="{{ route('status.edit', $status->id) }}">{{ __('status.edit') }}</a>
                </td>
                <td>
                    <form action="{{ route('status.destroy', $status->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger" type="submit">{{ __('status.delete') }}</button>
                    </form>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection