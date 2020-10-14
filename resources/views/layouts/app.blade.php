<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-param" content="_token" />

    <title>{{ config('app.name', 'Task manager') }}</title>

    <!-- Scripts -->
    @if(Request::secure())
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    @else
    <script src="{{ asset('js/app.js') }}" defer></script>
    @endif

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @if(Request::secure())
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @endif
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('welcome') }}">
                    {{ config('app.name', 'Task manager') }}
                </a>
                {{ Form::button('<span class="navbar-toggler-icon"></span>', [
                        'class' => 'navbar-toggler',
                        'data-toggle' => 'collapse',
                        'data-target' => '#navbarSupportedContent',
                        'aria-controls' => 'navbarSupportedContent',
                        'aria-expanded' => 'false',
                        'aria-label' => __('Toggle navigation'),
                    ])
                }}

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('task') || request()->is('task/*')) ? 'active' : '' }}" href="{{ route('task.index') }}">{{ __('task.mainTitle') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('status') || request()->is('status/*')) ? 'active' : '' }}" href="{{ route('status.index') }}">{{ __('status.mainTitle') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('label') || request()->is('label/*')) ? 'active' : '' }}" href="{{ route('label.index') }}">{{ __('label.mainTitle') }}</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('auth.login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('auth.register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" data-method="post" rel="nofollow">{{__('auth.logout')}}</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include("flash::message")
            </div>
            @yield('content')
        </main>
    </div>
</body>
</html>
