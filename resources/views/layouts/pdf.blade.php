<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'with Laravel') }} | FMSC </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">




    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ url('storage/images/uoj_logo.png')}}">

    <!-- Scripts -->
    {{-- Attached in head to run jQuery before body --}}
    <script src="{{ asset('js/app.js') }}"></script>
    
    
</head>

<body>

    <div class="container">            
        @yield('content')
        {{-- Content goes to here --}}            
    </div>



    {{-- footer start--}}
    {{-- <footer class="footer">   --}}
    <footer class="navbar-default navbar-fixed-bottom">
        <div class="container-fluid text-center" >
        {{-- <div class="container"> --}}
            <span>&copy; {{date('Y')}} Faculty of Management Studies &amp; Commerce - University of Jaffna</span>
        </div>
    </footer>
    {{-- footer end  --}}

</body>

</html>
