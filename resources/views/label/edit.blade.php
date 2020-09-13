@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('label.editorTitle') }}</h2>
    <form class="form-row" action="{{ route('label.update', $label->id) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="form-group col-md-12">
            <label for="name">{{ __('label.name') }}</label>
            <input class="form-control mr-2" id="name" name="name" type="text" value="{{ $label->name }}">
        </div>
        <div class="form-group col-md-12">
            <button class="btn btn-primary" type="submit">{{ __('label.save') }}</button>
        </div>
    </form>
</div>
@endsection
