<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="shortcut icon" href="{{ asset('assets/favicon.svg') }}" type="image/svg+xml">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 to-diamond-50 dark:from-gray-900 dark:to-black selection:bg-diamond-500 selection:text-white">

            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-diamond-700" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white dark:bg-gray-900 shadow-xl overflow-hidden sm:rounded-2xl border border-gray-100 dark:border-gray-800 relative">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-diamond-400 to-diamond-600"></div>

                {{ $slot }}
            </div>

            <div class="mt-6 text-center text-xs text-slate-400">
                &copy; {{ date('Y') }} DataScience Solutions. All rights reserved.
            </div>
        </div>
    </body>
</html>
