<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="/vendor/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/vendor/select2-bootstrap/dist/select2-bootstrap.min.css" rel="stylesheet">
    
    <link href="/vendor/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <link href="/vendor/jquery-ui/jquery-ui.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/site.css" rel="stylesheet">
    <link href="/css/guru.css" rel="stylesheet">

    @stack('header')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
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
                    <a class="navbar-brand guru-brand" href="{{ url('/') }}">
                        <img src="{{ config('app.logo', '/images/logo.png') }}" class="guru-brand" />
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li><a href="{{ url('/contato') }}">Contato</a></li>
                        <li><a href="{{ url('/agencias') }}">Agencias</a></li>
                        <li><a href="{{ url('/blog') }}">Blog</a></li>
                        
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}"><span class="fa fa-user"></span> ENTRAR</a></li>
                            <!--<li><a href="{{ url('/register') }}">Register</a></li>-->
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
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

        @yield('content')
    </div>

    <footer class="footer" style="background-color: #345C8C;">
        <div class="container">
            <p class="pull-left" style="color: #FFFFFF;">&copy; Paulo Roberto Leardi <?= date('Y') ?></p>
            <p class="pull-right"><a href="#" style="color: #E7E7E7;"><?= "by <b>GREP</b>" ?></a></p>
        </div>
    </footer>    
    
    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/vendor/select2/dist/js/select2.min.js"></script>
    <script src="/vendor/jquery-ui/jquery-ui.js"></script>
    <script src="/vendor/jquery.mask.min.js"></script>
</body>
</html>

@stack('scripts')

<script language="javascript">
$(document).ready(function() {
    
    $(".guru-select").select2({
        theme: "bootstrap",
        minimumResultsForSearch: 15
    });
    
    
});    
</script>

