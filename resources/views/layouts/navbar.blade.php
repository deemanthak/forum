<header>
    <!--========================== Header-Top ================================-->


    <!--========================== Header-Nav ================================-->
    <div class="header-nav">
        <nav class="navbar navbar-default">
            <div class="container">
                <p class="pull-left visible-xs">
                    <button type="button" class="navbar-toggle" data-toggle="offcanvas">
                        <i class="fa fa-long-arrow-right"></i>
                        <i class="fa fa-long-arrow-left"></i>
                    </button>
                </p>
                <div class="social-nav center-block visible-xs">
                    <li><a href="#"><i class="fa fa-twitter twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-facebook facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus google-plus"></i></a></li>
                </div>
                <!--toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-left">
                        <li><a href="{{ url('/') }}">home</a></li>
                        <li><a href="about.html">about</a></li>
                        <li><a href="contact.html">contact</a></li>
                        <li><a href="details.html">Post Details</a></li>

                    </ul>
                    <ul class="nav navbar-nav navbar-right hidden-xs">
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-->
        </nav>
    </div><!-- Header-Nav -->
</header>
