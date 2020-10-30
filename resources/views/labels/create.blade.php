@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('label.adderTitle') }}</h2>
    {{ Form::open(['url' => route('labels.store'), 'method' => 'POST', 'class' => 'form-row']) }}

    @include('labels.form')

    {{ Form::close() }}
</div>
@endsection
