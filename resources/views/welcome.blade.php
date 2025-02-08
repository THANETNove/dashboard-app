<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.head')



</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen  bg-center bg-gray-100 dark:bg-dots-lighter selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    @include('layouts.navbar')
                @else
                    <div class="main-header-welcome-2">
                        <a href="{{ route('login') }}" class="font-semibold-login">Log
                            in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="font-semibold-register">Register</a>
                        @endif
                    </div>


                @endauth
            </div>
        @endif


    </div>

    @include('layouts.script')
</body>

</html>
