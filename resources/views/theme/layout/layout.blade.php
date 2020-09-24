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

</head>
<body class="app py-0">
<div class="flex">
    @include('theme.include.mobile_menu')
    @include('theme.include.desktop_menu')
    <div class="content overflow-hidden">
        <div class="top-bar">
            @include('partials._breadcrumbs')
            <div class="intro-x dropdown w-8 h-8 relative">
                <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in">
                    @if(Auth()->user()->image)
                        <img alt="Midone Tailwind HTML Admin Template"
                             src="/storage/profile/{{Auth()->user()->id}}/{{Auth()->user()->image->name}}">
                    @else
                        <img alt="" class="rounded-full" src="/no-avatar.png">

                    @endif
                </div>
                <div class="dropdown-box mt-10 absolute w-56 top-0 right-0 z-20">
                    <div class="dropdown-box__content box bg-theme-38 text-white">
                        <div class="p-4 border-b border-theme-40">
                            @if(Auth()->user()->profile)
                                <div class="font-medium">{{Auth()->user()->profile->first_name}} {{Auth()->user()->profile->last_name}}</div>
                            @else
                                <div class="font-medium">{{Auth()->user()->name}}</div>
                            @endif
                            {{--                            <div class="text-xs text-theme-41">{{Auth()->user()->profile->position}}</div>--}}
                        </div>
                        <div class="p-2">
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-user w-4 h-4 mr-2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                Profile </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-edit w-4 h-4 mr-2">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                                Add Account </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-lock w-4 h-4 mr-2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                Reset Password </a>
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-help-circle w-4 h-4 mr-2">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                Help </a>
                        </div>
                        <div class="p-2 border-t border-theme-40">
                            <a href=""
                               class="flex items-center block p-2 transition duration-300 ease-in-out hover:bg-theme-1 rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                     stroke-linejoin="round" class="feather feather-toggle-right w-4 h-4 mr-2">
                                    <rect x="1" y="5" width="22" height="14" rx="7" ry="7"></rect>
                                    <circle cx="16" cy="12" r="3"></circle>
                                </svg>
                                Logout </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Account Menu -->
        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ url('theme/js/app.js') }}"></script>
<script src="{{ url('js/app.js') }}"></script>
@yield('custom_scripts')
</body>

</html>
