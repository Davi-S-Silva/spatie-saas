@php
    // dd(session('tenant_id'));
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Scripts -->

    <link href="{{ asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100">

        @include('layouts.navigation')
        <div class="overflow-y-hidden absolute right-0 m-2">
            @if (session('message'))
                @php
                    $message = session('message');
                @endphp
                <div class=" alert alert-{{ $message['status'] }} response-message">
                    {{ $message['msg'] }}
                </div>
            @endif
            <div class="alert response-message-ajax">
            </div>
        </div>

        <div class="loading d-none">
            <img src="{{ asset('img/loading.gif') }}" alt="">
        </div>
        <!-- Page Heading -->
        <header class="bg-white overflow-y-hidden shadow d-flex align-items-center">
            @if (isset($header))
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-7">
                    {{ $header }}
                </div>
            @endif
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-7 text-center">
                <form action="{{ route('search') }}" method="post" name="FormSearch" class="d-flex">
                    <input type="search" name="search" id="" placeholder="Digite para pesquisar">
                    @csrf
                    <button class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main class="d-flex">
            @include('layouts.sidebar')
            <div class="w-100">
                {{ $slot }}
            </div>
        </main>
    </div>

</body>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
@vite('resources/js/app.js')
<script src="{{ asset('js/ajax.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>

</html>
