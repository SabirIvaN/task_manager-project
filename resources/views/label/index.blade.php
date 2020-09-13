@extends('layouts.app')

@section('content')
<div class="container">
    @include("flash::message")
    <div class="d-flex justify-content-between align-items-center flex-wrap mt-1 mb-3">
        <h2>{{ __('label.mainTitle') }}</h2>
        @if(Auth::user())
        @if(Auth::user()->hasVerifiedEmail())
        <div class="btn-toolbar">
            <a class="btn btn-success" href="{{ route('label.create') }}">{{ __('label.add') }}</a>
        </div>
        @endif
        @endif
    </div>
    @if($labels->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th scope="col">{{ __('label.id') }}</th>
                <th scope="col">{{ __('label.name') }}</th>
                <th scope="col" @if(Auth::user()) @if(Auth::user()->hasVerifiedEmail()) colspan="3" @endif @endif>{{ __('label.date') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($labels as $label)
            <tr>
                <th scope="row">{{ $label->id }}</th>
                <td>{{ $label->name }}</td>
                <td>{{ $label->created_at }}</td>
                @if(Auth::user())
                @if(Auth::user()->hasVerifiedEmail())
                <td>
                    <a class="btn btn-primary" href="{{ route('label.edit', $label->id) }}">{{ __('label.edit') }}</a>
                </td>
                <td>
                    <form action="{{ route('label.destroy', $label->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">{{ __('label.delete') }}</button>
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
