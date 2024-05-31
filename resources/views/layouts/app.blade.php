<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title> @yield('title') | {{ config('app.name', 'Uniformes la Abejita 22') }}</title> 

        <!-- Styles and Resources -->
        <link rel="shortcut icon" href="/images/logo.png" type="image/x-icon">
        <script src="https://kit.fontawesome.com/eb36e646d1.js" crossorigin="anonymous"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-slate-50 font-[system-ui]">

        <!-- Header -->
        @include('layouts.navigation')
        
        <!-- Page Content -->
        @yield('content')

        <!-- Footer -->
        @include('layouts.footer')
    </body>
</html>
