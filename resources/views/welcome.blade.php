@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>{{ __('welcome.title') }}</h1>
        <p class="lead">{{ __('welcome.description') }}</p>
        <hr>
        <p class="lead">{{ __('welcome.subtitle') }}</p>
        <a class="btn btn-primary btn-lg" href="https://ru.hexlet.io/professions/php/projects/57">{{ __('welcome.link') }}</a>
    </div>
</div>
@endsection
