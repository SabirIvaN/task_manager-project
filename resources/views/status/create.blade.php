@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.adderTitle') }}</h2>
    {{ Form::open(['url' => route('statuses.store'), 'method' => 'POST', 'class' => 'form-row']) }}

    @include('status.form')

    {{ Form::close() }}
</div>
@endsection
