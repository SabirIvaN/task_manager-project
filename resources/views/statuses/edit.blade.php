@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('status.editorTitle') }}</h2>
    {{ Form::open(['url' => route('statuses.update', $status), 'method' => 'PUT', 'class' => 'form-row']) }}

    @include('statuses.form')

    {{ Form::close() }}
</div>
@endsection
