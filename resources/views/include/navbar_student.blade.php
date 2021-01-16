<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            {{-- Notifications --}}
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-bell"></i>
                    @if(Auth::user()->unreadNotifications->count())
                        <span class="badge badge-light">{{Auth::user()->unreadNotifications->count()}}</span>
                    @endif

                    <b class="caret"></b>
                </a>

                @if(Auth::user()->unreadNotifications->count())
                    <ul class="dropdown-menu alert-dropdown" style="overflow:auto; height:500px" >
                            <li>
                                <a href="{{route('markAllAsRead')}}">Mark all as read</a>
                            </li>

                            <li class="divider"></li>


                            
                        @foreach (Auth::user()->unreadNotifications as $notification)
                        <li>
                            <a href="#">Results has been published for <strong>{{$notification->data['subject_code']}}</strong> - <strong>{{$notification->data['title']}}</strong> in exam year {{$notification->data['exam_year']}} <span class="label label-primary">New Result Alert </span></a>
                        </li>                                                  
                        @endforeach

                    </ul>
                @endif

            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>
    
                <ul class="dropdown-menu" role="menu">
    
                    <li>
                        <a href="/dashboard">Dashboard</a>
                    </li>
                    
                    <li>
                        <a href="/profile">Profile</a>
                    </li>
                    
                    <li class="divider"></li>
                     
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                 
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                    
                    
                    
                    
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
    
                {{-- Dashboard  --}}
                <li class=" {{(Request::is('dashboard')) ? 'active' : '' }}">
                    <a href="/dashboard"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</a>
                </li>
                
                {{-- grades --}}
                <li class=" {{(Request::is('grades')) ? 'active' : ((Request::is('grades/*')) ? 'active' : '') }}">
                    <a href="/grades/{{Auth::user()->user_name}}"><span class="glyphicon glyphicon-text-background"></span> Results</a>
                </li>               
    
                {{-- profile  --}}
                <li class=" {{(Request::is('profile')) ? 'active' : ((Request::is('profile/*')) ? 'active' : '') }}">
                    <a href="/profile"><span class="glyphicon glyphicon-heart"></span> Profile</a>
                </li>                                   
        
                {{-- gpa  --}}
                <li class=" {{(Request::is('gpa')) ? 'active' : ((Request::is('gpa/*')) ? 'active' : '') }}">
                    <a href="/gpa"><span class="glyphicon glyphicon-flash"></span> GPA</a>
                </li>
    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>