@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.adderTitle') }}</h2>
    <form action="{{ route('status.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('status.name') }}</label>
            <input class="form-control mr-2" id="name" name="name" type="text">
        </div>
        <button class="btn btn-primary" type="submit">{{ __('status.save') }}</button>
    </form>
</div>
@endsection
