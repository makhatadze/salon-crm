<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Midone - Tailwind HTML Admin Template</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ url('theme/images/logo.svg') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ url('theme/css/app.css') }}">
    <link rel="stylesheet" href="{{ url('theme/css/custom.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
    @livewireStyles
</head>

<body class="app py-0" style="background: radial-gradient(circle, rgb(0 59 124) 0%, rgb(145 109 168) 100%)">
<div class="flex" id="app-wrap">
    @include('theme.include.mobile_menu')
    @include('theme.include.desktop_menu')
    <div class="content overflow-auto" style="background-color: #f1f5f8">

        {{-- Cart Modal End --}}
       <x-navbar/>
                
        @include('theme.layout.alerts')

        @if (session('status'))
            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-9 text-white font-helvetica">
                <i data-feather="circle" class="w-6 h-6 mr-2"></i>
                {{ session('status') }}
            </div>
        @endif
        @if (session('status-false'))
            <div class="grid grid-cols-12 gap-6 mt-5">
                <div class="intro-y col-span-12 lg:col-span-8">
                    <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white font-helvetica">
                        <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>
                        {{ session('status-false') }}
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</div>
@livewireScripts

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ url('theme/js/app.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
<script src="{{ asset('../js/responsive.js') }}"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@yield('custom_scripts')
</body> 

</html>
