<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Dashboard - Midone - Tailwind HTML Admin Template</title>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ url('theme/images/logo.svg') }}" rel="shortcut icon">
        <link rel="stylesheet" href="{{ url('theme/css/app.css') }}">

    </head>
    <body class="app">
        <div class="flex">
            @include('theme.include.mobile_menu')
            @include('theme.include.desktop_menu')
            <div class="content">
                <div class="top-bar">
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="breadcrumb--active">ადმინისტრატორის სივრცე</a> </div>
                </div>
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
                @foreach ($errors->all() as $error)
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="intro-y col-span-12 lg:col-span-8">
                            <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-6 text-white font-helvetica"> 
                                <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i>
                                    {!! $error !!}
                            </div>
                        </div>
                    </div>
                @endforeach
                @yield('content')
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="{{ url('theme/js/app.js') }}"></script>
        @yield('custom_scripts')
    </body>
</html>