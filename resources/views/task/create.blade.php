@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.adderTitle') }}</h2>
    {{ Form::open(['url' => route('task.store'), 'method' => 'POST']) }}

    @include('task.form')

    {{ Form::close() }}
</div>
@endsection
