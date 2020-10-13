@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.register') }}</div>

                <div class="card-body">
                    {{ Form::open(['method' => 'POST', 'url' => route('register')]) }}

                    <div class="form-group row">
                        {{ Form::label('name', __('auth.name'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::text('name', old('name'), [
                                    'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null),
                                    'required' => true,
                                    'autocomplete' => 'name',
                                    'autofocus' => true,
                                    'id' => 'name',
                                ])
                            }}

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        {{ Form::label('email', __('auth.email'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::email('email', old('email'), [
                                    'class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null),
                                    'required' => true,
                                    'autocomplete' => 'email',
                                    'id' => 'email',
                                ])
                            }}

                            @error('email')
                                <span class="invalid-feedback" role="alert">
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
                                    'autocomplete' => 'new-password',
                                    'id' => 'password',
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
                        {{ Form::label('password-confirm', __('auth.confirm'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                        <div class="col-md-6">
                            {{ Form::password('password_confirmation', [
                                    'class' => 'form-control',
                                    'required' => true,
                                    'autocomplete' => 'new-password',
                                    'id' => 'password-confirm',
                                ])
                            }}
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            {{ Form::submit(__('auth.register'), ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
