@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.confirm') }}</div>

                <div class="card-body">
                    {{ __('auth.please') }}

                    {{ Form::open(['method' => 'POST', 'url' => route('password.confirm')]) }}

                        <div class="form-group row">
                            {{ Form::label('password', __('auth.password'), ['class' => 'col-md-4 col-form-label text-md-right']) }}

                            <div class="col-md-6">
                                {{ Form::password('password', [
                                        'class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null),
                                        'required' => true,
                                        'autocomplete' => 'current-password',
                                        'autofocus' => true,
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{ Form::submit(__('auth.confirm'), ['class' => 'btn btn-primary']) }}

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
