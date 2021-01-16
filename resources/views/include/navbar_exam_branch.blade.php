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
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i> <b class="caret"></b></a>
                {{-- <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-success">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-info">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-warning">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="#">Alert Name <span class="label label-danger">Alert Badge</span></a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul> --}}
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
                    <a href="/grades"><span class="glyphicon glyphicon-text-background"></span> Results</a>
                </li>               
    
                {{-- profile  --}}
                <li class=" {{(Request::is('profile')) ? 'active' : ((Request::is('profile/*')) ? 'active' : '') }}">
                    <a href="/profile"><span class="glyphicon glyphicon-heart"></span> Profile</a>
                </li>
                   
                {{-- Reports  --}}
                <li class=" {{(Request::is('reports')) ? 'active' : ((Request::is('reports/*')) ? 'active' : '') }}">
                    <a href="/reports"><span class="glyphicon glyphicon-stats"></span> Reports</a>
                </li>    
    
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>