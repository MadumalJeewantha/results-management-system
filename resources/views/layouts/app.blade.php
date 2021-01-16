<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'with Laravel') }} | FMSC </title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Toastr notifications -->
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    {{-- Animate CSS --}}
    <link href="{{ asset('css/animate.min.css') }}" rel="stylesheet">    
    {{-- Particle Animation --}}
    {{-- <link href="{{ asset('css/particles.css') }}" rel="stylesheet"> --}}
    {{-- Particle Animation --}}
    {{-- <script src="{{ asset('js/particles.json.data.js') }}"></script>
    <script src="{{ asset('js/particles.min.js') }}"></script>  --}}


    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ url('storage/images/uoj_logo.png')}}">

    <!-- Scripts -->
    {{-- Attached in head to run jQuery before body --}}
    <script src="{{ asset('js/app.js') }}"></script>
    
    <style type="text/css">
        body, html{
           height: 100%;
           margin: 0;
        }

        .bg{
            /* image */
            background-image: url('/storage/images/wave-background.svg');
            /* Full height */
            height: 100%;
            /* Center & Scale */
            background-position:  left top;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .text-shadow-effect{
            color: white;
            /* color: #11256f; */
            text-shadow: 2px 2px 4px #000000;
        } 
        
    </style>
</head>

<body style="padding-top: 70px;" class="bg">
<!--min-height: 2000px;-->
    <div id="app">

        <!--Include top navbar-->
        @include('include.navbar')

        <div class="container"> 
            {{-- col-lg-12 --}}
            
            <!--Include flash messages-->
            @include('include.messages')

            @yield('content')
            {{-- Content goes to here --}}
            
        </div>
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


    <!-- Other Scripts -->

    <!-- Toastr notifications -->
    <script src="{{ asset('js/toastr.min.js') }}"></script>
       
    
</body>

</html>
