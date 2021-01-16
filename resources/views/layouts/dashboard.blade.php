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
        <!--SB Admin template-->
        <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
        {{-- DataTables --}}
        <link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet">
        {{-- Bootstrap-select --}}
        <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
        {{-- Confirmation plugin --}}
        <link href="{{ asset('css/alertBox.css') }}" rel="stylesheet">
                
        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ url('storage/images/uoj_logo.png')}}">

        <!-- Scripts -->
        {{-- Attached in head to run jQuery before body --}}
        <script src="{{ asset('js/app.js') }}"></script>

        {{-- Chart.js --}}
        <script src="{{ asset('js/Chart.js') }}"></script>
        
        
    </head>

    <body style="padding-top: 50px;">

        <div id="wrapper">
            
            {{-- Check auth user type for change side navbar --}}
            <?php $type = Auth::user()->type; ?>            
            @if($type == "dean")          
                @include('include.navbar_dean')

            @elseif($type == "ar")
                @include('include.navbar_ar')
            
            @elseif($type == "lecture")
                @include('include.navbar_lecture')
            
            @elseif($type == "student")
                @include('include.navbar_student')

            @elseif($type == "examination_branch")
                @include('include.navbar_exam_branch')
            
            @endif

            <div id="page-wrapper">

                <div class="container col-lg-12">
                    <!--Include flash messages-->
                    @include('include.messages')                                 
                </div>

                <div class="container-fluid">
        
                         @yield('content')
                        {{-- Content goes to here --}}

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->



        {{-- footer start--}}
        {{-- <footer class="footer">   --}}
        <footer class="navbar-inverse navbar-fixed-bottom">
            <div class="container-fluid text-center" >
                {{-- <div class="container"> --}}
                <span>&copy; {{date('Y')}} Faculty of Management Studies &amp; Commerce - University of Jaffna</span>
            </div>
        </footer>
        {{-- footer end  --}}


        <!-- Other Scripts -->

        <!-- Toastr notifications -->
        <script src="{{ asset('js/toastr.min.js') }}"></script>
        <script>
                @if(Session::has('message'))
                  var type = "{{ Session::get('alert-type', 'info') }}";
                  switch(type){
                      case 'info':
                          toastr.info("{{ Session::get('message') }}" , 'Information', {timeOut: 5000});
                          break;
                      
                      case 'warning':
                          toastr.warning("{{ Session::get('message') }}" , 'Warning', {timeOut: 5000});
                          break;
              
                      case 'success':
                          toastr.success("{{ Session::get('message') }}" , 'Success Alert', {timeOut: 5000});
                          break;
              
                      case 'error':
                          toastr.error("{{ Session::get('message') }}" , 'Whoops, somethig went wrong', {timeOut: 5000});
                          break;
                  }
                @endif
        </script>

        {{-- DataTables --}}
        <script src="{{ asset('js/datatables.min.js') }}"></script> 
        {{-- Bootstrap-select --}}
        <script src="{{ asset('js/bootstrap-select.min.js') }}"></script> 
        {{-- alertBox - Confirmation Plugin --}}
        <script src="{{ asset('js/alertBox.js') }}"></script>

        <script src="{{ asset('js/jquery.confirm.min.js') }}"></script>


        


        
                                           
    </body>

</html>
