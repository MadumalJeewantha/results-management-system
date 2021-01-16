<nav class="navbar navbar-default navbar-fixed-top"> 
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            {{-- <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'With Laravel') }}                    
            </a> --}}

        </div>

        <div class="collapse navbar-collapse"  id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li class="{{(isset($IndexClass))== true ? 'active' :''}}"><a href="/">Home</a></li>
                <li class="{{(isset($AboutClass))== true ? 'active' :''}}"><a href="/about">About</a></li>
                <li class="{{(isset($ContactClass))== true ? 'active' :''}}"><a href="/contact/create">Contact</a></li>
                <li class="{{(isset($HelpClass))== true ? 'active' :''}}"><a href="/help">Help</a></li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('login') }}">Login</a></li>
                {{-- Because students & lectures are registered by dean or AR --}}
                {{-- <li><a href="{{ route('register') }}">Register</a></li> --}}
                        @else                        

                    {{-- Primary options --}}
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">

                            {{-- dashboard --}}
                            <li>
                                <a href="/dashboard">Dashboard</a>
                            </li>

                            {{-- profile --}}
                            <li>
                                <a href="/profile">Profile</a>
                            </li>

                            {{-- logout --}}
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
                    @endif
            </ul>
        </div>
    </div>

</nav>
