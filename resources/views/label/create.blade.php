@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('label.adderTitle') }}</h2>
    {{ Form::model($label, ['url' => route('label.store'), 'class' => 'form-row']) }}
    <div class="form-group col-md-12">
    {{ Form::label('name', __('label.name')) }}
    {{ Form::text('name', null, ['class' => 'form-control mr-2' . ($errors->has('name') ? ' is-invalid' : '')]) }}
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
    </div>
    <div class="form-group col-md-12">
    {{ Form::submit(__('label.save'), ['class' => 'btn btn-primary']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection
