<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body class="full-screen">
        <div class="container d-flex align-items-center justify-content-between pt-3">
            <div>
                <a class="" href="/">
                    <img src="/img/small_logo.png" alt="logo" />
                </a>
            </div>
            @if (Route::has('login'))
                <div class="buttons">
                    @auth
                        <a href="javascript:void" onclick="$('#logout-form').submit();" class="btn btn-orange ml-3">{{ __('Log out') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @else
                        <a href="#" class="btn btn-orange ml-3" data-toggle="modal" data-target="#loginModal">{{ __('Login') }}</a>
                    @endauth
                </div>
            @endif
        </div>

<!-- login as modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="w-100 text-center mb-3">{{ __('Login as') }}</h3>
                <div class="row flex-row">
                    <div class="col-md-6 pr-md-1">
                        <div class="wrapper-card text-center">
                            <img src="/img/trainer.png">
                            <a href="#" class="btn btn-secondary mt-3" data-toggle="modal" data-target="#trainerModal" data-dismiss="modal">{{ __('Trainer') }}</a>
                        </div>
                    </div>
                    <div class="col-md-6 pl-md-1">
                        <div class="wrapper-card text-center">
                            <img src="/img/student.png">
                            <a href="#" class="btn btn-secondary mt-3" data-toggle="modal" data-target="#studentModal" data-dismiss="modal">{{ __('Student') }}</a>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- login trainer modal-->
<div class="modal fade" id="trainerModal" tabindex="-1" role="dialog" aria-labelledby="trainerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <img src="/img/trainer.png">
            </div>
            <div class="modal-body px-5">
                <h3 class="w-100 text-center mb-3">{{ __('Trainer') }}</h3>
                
                <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-2">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-2">

                <button class=" btn btn-orange w-100">
                    {{ __('Sign in') }}
                </button>
            </div>
            <div class="flex items-center justify-center mt-3 back">
                <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
            </div>
            
        </form>
            </div>
        </div>
    </div>
</div>
<!-- login student modal-->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header align-items-center">
                <img src="/img/student.png">
            </div>
            <div class="modal-body px-5">
                <h3 class="w-100 text-center mb-3">{{ __('Student') }}</h3>
                
                <form method="POST" action="">
            @csrf

            <!-- Course Name(Code) -->
            <div>
                <x-label for="name" :value="__('Course(Code)')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name"  required autofocus />
            </div>

            <!-- PIN -->
            <div class="mt-2">
                <x-label for="pin"  :value="__('PIN')"/>

                <x-input id="pin" class="block mt-1 w-full"
                                type="text"
                                name="pin"
                                required  />
            </div>

            <div class="flex items-center justify-center mt-3">

            <a href="#" class=" btn btn-orange w-100" id="btn-login" >
                {{ __('Sign in') }}
            </a>
            </div>
            <div class="flex items-center justify-center mt-3 back">
                <a href="#" data-toggle="modal" data-target="#loginModal" data-dismiss="modal"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
            </div>
            
        </form>
            </div>
        </div>
    </div>
</div>

<!-- loginStdModal modal -->
<div class="modal fade" id="loginStdModal" tabindex="-1" role="dialog" aria-labelledby="loginStdModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body px-0 pt-0">
                <img src="/img/student2.jpg">
                <h2 class="w-100 text-center mt-3 mb-3 title">{{ __('Course Group') }} <span id="g_name"></span><br> {{ __('Level') }} <span id="s_level"></span></h2>
                <p class="text-center mb-4">{{ __('Are you') }} <span id="st_name"></span>?</p>
                <form method="POST" action="{{ route('login') }}">
                     @csrf
                    <input type="hidden" id="class_id" name="class_id">
                    <input type="hidden" id="email2" name="email" >
                    <input type="hidden" id="password2" name="password" >
                    <input type="hidden" id="remember" name="remember" value="false">
                    <div class="d-flex justify-content-center">
                        <button class=" btn btn-orange mx-2">
                            <i class='fas fa-check'></i> {{ __('Yes') }}
                        </button>
                        <a href="#" class=" btn btn-secondary mx-2" data-dismiss="modal" >
                        <i class='fas fa-times'></i> {{ __('No') }}
                        </a>
                    </div>
                </form>     
            </div>
        </div>
    </div>
</div>
        <!-- Scripts -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="{{ asset('/js/custom.js') }}" defer></script>
    </body>
</html>
