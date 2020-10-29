@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('label.editorTitle') }}</h2>
    {{ Form::open(['url' => route('labels.update', $label), 'method' => 'PUT', 'class' => 'form-row']) }}

    @include('label.form')

    {{ Form::close() }}
</div>
@endsection
