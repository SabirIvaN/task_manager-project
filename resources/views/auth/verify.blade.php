@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('auth.verify') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('auth.fresh') }}
                        </div>
                    @endif

                    {{ __('auth.check') }}
                    {{ __('auth.receive') }},
                    {{ Form::open(['method' => 'POST', 'url' => route('verification.resend'), 'class' => 'd-inline']) }}
                        {{ Form::submit(__('auth.click'), ['class' => 'btn btn-link p-0 m-0 align-baseline']) }}.
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
