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
        {{-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-envelope"></i> <b class="caret"></b></a>
            <ul class="dropdown-menu message-dropdown">
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-preview">
                    <a href="#">
                        <div class="media">
                            <span class="pull-left">
                                <img class="media-object" src="http://placehold.it/50x50" alt="">
                            </span>
                            <div class="media-body">
                                <h5 class="media-heading">
                                    <strong>John Smith</strong>
                                </h5>
                                <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                <p>Lorem ipsum dolor sit amet, consectetur...</p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="message-footer">
                    <a href="#">Read All New Messages</a>
                </li>
            </ul>
        </li> --}}
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-bell"></i> <b class="caret"></b></a>
            {{-- <ul class="dropdown-menu alert-dropdown">                                            
            
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
            
             {{-- profile  --}}
             <li class=" {{(Request::is('profile')) ? 'active' : ((Request::is('profile/*')) ? 'active' : '') }}">
                <a href="/profile"><span class="glyphicon glyphicon-heart"></span> Profile</a>
            </li>

            {{-- grades --}}
            <li class=" {{(Request::is('grades')) ? 'active' : ((Request::is('grades/*')) ? 'active' : '') }}">
                <a href="/grades"><span class="glyphicon glyphicon-text-background"></span> Results</a>
            </li>

            {{-- Users -> Students | Lectures --}}
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#users"><span class="glyphicon glyphicon-user"></span> Users <span class="glyphicon glyphicon-menu-down"></span></a>
                <ul id="users" class="collapse">
                    <li class=" {{(Request::is('students')) ? 'active' : ((Request::is('students/*')) ? 'active' : '') }}">
                        <a href="/students">Students</a>
                    </li>
                    <li class=" {{(Request::is('lectures')) ? 'active' : ((Request::is('lectures/*')) ? 'active' : '') }}">
                        <a href="/lectures">Lecturers</a>
                    </li>
                </ul>
            </li>

            {{-- Departments  --}}
            <li class=" {{(Request::is('departments')) ? 'active' : ((Request::is('departments/*')) ? 'active' : '') }}">
                <a href="/departments"><span class="glyphicon glyphicon-blackboard"></span> Departments</a>
            </li>

            {{-- Courses  --}}
            <li class=" {{(Request::is('courses')) ? 'active' : ((Request::is('courses/*')) ? 'active' : '') }}">
                <a href="/courses"><span class="glyphicon glyphicon-education"></span> Courses</a>
            </li>

            {{-- Subjects  --}}
            <li class=" {{(Request::is('subjects')) ? 'active' : ((Request::is('subjects/*')) ? 'active' : '') }}">
                <a href="/subjects"><span class="glyphicon glyphicon-th-list"></span> Subjects</a>
            </li>
        
            {{-- Reports  --}}
            <li class=" {{(Request::is('reports')) ? 'active' : ((Request::is('reports/*')) ? 'active' : '') }}">
                <a href="/reports"><span class="glyphicon glyphicon-stats"></span> Reports</a>
            </li>

            {{-- Messages/contact  --}}
            <li class=" {{(Request::is('contact')) ? 'active' : ((Request::is('contact/*')) ? 'active' : '') }}">
            <a href="/contact"><span class="glyphicon glyphicon-envelope"></span> Message Box <span class="label label-primary">{{ //Seng messages count
                    App\Contact::where('response', 0)->count()}}</span></a>
            </li>



            {{-- Settings  --}}
            <li class=" {{(Request::is('settings')) ? 'active' : ((Request::is('settings/*')) ? 'active' : '') }}">
                <a href="/settings"><span class="glyphicon glyphicon-cog"></span> Settings</a>
            </li>

        </ul>
    </div>
    <!-- /.navbar-collapse -->
</nav>