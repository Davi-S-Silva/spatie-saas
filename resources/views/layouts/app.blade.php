@php
    // dd(session('tenant_id'));
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->

    <link href="{{ asset('fontawesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" media="screen" rel="stylesheet">
    <link rel="stylesheet" media="print" href="{{ asset('css/print.css') }}" />
    <!-- Scripts -->

    {{-- MAPA --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css"
integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="anonymous" /> --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
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

        {{-- INCLUDES AJAX --}}

        <div id="IncludeResponseAjax">
        </div>
        <div id="ResponseSearchAjax" class="bg-white overflow-hidden sm:rounded-lg p-2">
            <header class="d-flex justify-between">
               <div> Resultado de busca para o termo: <b><span id="TextSearch"></span></b></div>
               <div><a href=""><i class="fa-regular fa-rectangle-xmark cursor-pointer close-result-searach"></i></a></div>
            </header>
            <div class="response_search_ajax"></div>
        </div>
        {{-- FIM INCLUDES AJAX --}}


        <!-- Page Heading -->
        <header class="bg-white overflow-y-hidden shadow d-flex align-items-center header_sistema">
            @if (isset($header))
                <div class="mx-auto py-6 px-4 sm:px-6 lg:px-7">
                    {{ $header }}
                </div>
            @endif
            <div class="mx-auto py-6 px-4 sm:px-6 lg:px-7 text-center d-flex align-items-center justify-between">

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
            <div class="w-100 conteudo_sistema">
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
{{-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-1754079157113278"
     crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"
     integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin="anonymous"></script> --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
{{-- <script src="{{ asset('js/leaflet-measure.js') }}"></script> --}}
<script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

</html>
