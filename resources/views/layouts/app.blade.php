<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    @include('layouts.head')
</head>

<body>

    @guest {{-- ยังไม่ได้ login --}}
        @yield('content')
    @else
        {{-- login แล้ว --}}
        <div class="wrapper">
            @include('layouts.sidebar')
            <div class="main-panel">
                @include('layouts.navbar')
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    @endguest


    @include('layouts.script')
</body>

</html>
