@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.editorTitle') }}</h2>
    <form class="form-inline" action="{{ route('status.update', $status->id) }}" method="POST">
        @method('PUT')
        @csrf
        <label class="d-none" for="statusName">{{ __('status.name') }}</label>
        <input class="form-control mr-2 w-75" id="name" name="name" type="text" value="{{ $status->name }}">
        <button class="btn btn-primary" type="submit">{{ __('status.save') }}</button>
    </form>
</div>
@endsection
