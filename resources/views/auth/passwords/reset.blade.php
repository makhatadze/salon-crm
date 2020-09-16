<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRM DIMOND</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="{{ url('theme/images/logo.svg') }}" rel="shortcut icon">
    <link rel="stylesheet" href="{{ url('theme/css/app.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body class="login">
<div class="container sm:px-10">
    <div class="block xl:grid grid-cols-2 gap-4">
        <div class="hidden xl:flex flex-col min-h-screen">
            <div class="my-auto">
                <img alt="" class="-intro-x w-1/2 -mt-16" src="{{ url('theme/images/illustration.svg')}}">
                <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                    A few more clicks to
                    <br>
                    sign in to your account.
                </div>
                <div class="-intro-x mt-5 text-lg text-white">Manage all your e-commerce accounts in one place</div>
            </div>
        </div>
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div
                class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                    Account Email
                </h2>
                <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">A few more clicks to sign in to your
                    account. Manage all your e-commerce accounts in one place
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="email" type="email"  class="intro-x login__input input input--lg border border-gray-300 block mt-2" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <input id="password" placeholder="ახალი პაროლი" type="password"  class="intro-x login__input input input--lg border border-gray-300 block mt-2" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="password-confirm" placeholder="გაიმეორეთ პაროლი" type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-2" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="button button--lg w-full xl:w-auto mt-2 text-white bg-theme-1 xl:mr-3">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ url('theme/js/app.js') }}"></script>
</body>
</html>

