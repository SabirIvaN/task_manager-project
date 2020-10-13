@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.login') }}</div>

                <div class="card-body">
                    {{ Form::open(['method' => 'POST', 'url' => route('login')]) }}

                    <div class="form-group row">
                        {{ Form::label('email', __('auth.email'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::text('email', old('email'), [
                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null),
                                    'required' => true,
                                    'autocomplete' => 'email',
                                    'autofocus' => true,
                                    'id' => 'email',
                                ])
                            }}

                            @error('email')
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('password', __('auth.password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::password('password', [
                                    'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null),
                                    'required' => true,
                                    'autocomplete' => 'current-password',
                                    'id' => 'email',
                                ])
                            }}

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                {{ Form::checkbox('remember', null, old('remember') ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'remember']) }}

                                {{ Form::label('remember', __('auth.remember'), ['class' => 'form-check-label']) }}
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            {{ Form::submit(__('auth.login'), ['class' => 'btn btn-primary']) }}

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('auth.forgot') }}
                                </a>
                            @endif
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
