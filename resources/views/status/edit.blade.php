@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.editorTitle') }}</h2>
    {{ Form::open(['url' => route('status.update', $status), 'method' => 'PUT', 'class' => 'form-row']) }}

    @include('status.form')

    {{ Form::close() }}
</div>
@endsection
