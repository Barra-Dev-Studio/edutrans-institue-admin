<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "Laravel") }}</title>
        @if(env('APP_ENV') === 'local')
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/icons.css'])
        @else
        <link rel="stylesheet" href="{{ asset('build/assets/app-605fc313.css') }}">
        <link rel="stylesheet" href="{{ asset('build/assets/icons-adf300ab.css') }}">
        <script src="{{ asset('build/assets/app-02317797.js') }}"></script>
        @endif
    </head>
    <body data-mode="light" data-sidebar-size="lg">
        @include('layouts.partials.topbar') @include('layouts.partials.sidebar')
        <div class="main-content">
            <div class="page-content dark:bg-zinc-700 min-h-screen">
                <div class="container-fluid px-[0.625rem]">
                    {{ $slot }}
                    @include('layouts.partials.footer')
                </div>
            </div>
        </div>
        @include('layouts.partials.scripts')
        @stack('js')
    </body>
</html>
