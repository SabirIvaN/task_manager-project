@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mt-1 mb-3">{{ __('task.editorTitle') }}</h2>
    {{ Form::open(['url' => route('task.update', $task->id), 'method' => 'PUT', 'class' => 'form-row']) }}

    @include('task.form')

    {{ Form::close() }}
</div>
@endsection
