<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="keywords" content="{{ setting('meta_keywords') }}">
    <meta name="description" content="{{ setting('meta_description') }}">
    <meta name="robots" content="index, follow">

    <meta property="og:locale" content="pt_BR" />
    <meta property="og:site_name" content="{{ setting('site_title') }}" />
    <meta property="og:type" content="article" />
    <meta property="og:image" content="https://i.imgur.com/4wihrL1.png" />
    <meta property="og:image:width" content="428">
    <meta property="og:image:height" content="210">
    <meta property="og:url" content="{{ url('/') }}" />
    <meta property="og:title" content="{{ setting('site_title') }}" />
    <meta property="og:description" content="{{ setting('meta_description') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">

    <title>{{ setting('site_title') }} :: Termos</title>

    <!-- Favicons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.png') }}">

    <link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ asset('images/favicons/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ asset('images/favicons/ms-icon-150x150.png') }}" sizes="150x150">
    <link rel="icon" type="image/png" href="{{ asset('images/favicons/android-icon-192x192.png') }}" sizes="192x192">

    <link rel="manifest" href="{{ asset('images/favicons/manifest.json') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('images/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-icon-180x180.png') }}">
    <!-- END Favicons -->

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="{{ asset('index/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Pixeden Icon Font -->
    <link href="{{ asset('fonts/pe-icon-7-stroke.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ asset('index/css/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Style -->
    <link href="{{ asset('index/css/style.css') }}" rel="stylesheet">

    <link href="{{ asset('index/css/animate.css') }}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{ asset('index/css/responsive.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<!-- PRELOADER -->
<div class="spn_hol">
    <div class="spinner">
        <div class="bounce1"></div>
        <div class="bounce2"></div>
        <div class="bounce3"></div>
    </div>
</div>
<!-- END PRELOADER -->

<!-- START ABOUT US SECTION -->
<section class="header parallax home-parallax page" id="HOME">
    <h2></h2>
    <div class="section_overlay">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        <img src="{{ asset('images/favicons/favicon-16x16.png') }}" alt="Logo">
                    </a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <!-- NAV -->
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}">Cadastre-se</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                        @if(!empty(setting('discord')))
                            <li>
                                <a href="{{ hideref(setting('discord')) }}" target="_blank">Discord Chat</a>
                            </li>
                        @endif
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container- -->
        </nav>

        <div class="container home-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="logo text-center">
                        <!-- LOGO -->
                        <img width="125" height="55" src="{{ asset('images/favicons/apple-icon-114x114.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="home_text">
                        <!-- TITLE AND DESC -->
                        <h1>Brilliant Landing Page Design. Executed for Your App</h1>
                        <p>Now create a beautiful, app landing page.</p>

                        <div class="download-btn">
                            <!-- BUTTON -->
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ route('home') }}" class="tour btn wow fadeInDown">Home</a>
                                @else
                                    <a href="{{ route('login') }}" class="tuor btn wow fadeInLeft">Login</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="btn home-btn wow fadeInRight">Cadastre-se</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END HEADER SECTION -->

<!-- START FEATURES -->
<section id="FEATURES" class="features page">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <!-- FEATURES SECTION TITLE -->
                <div class="section_title wow fadeIn" data-wow-duration="1s">
                    <h2>Termos</h2>
                    <p>{!! setting('terms') !!}</p>
                </div>
                <!-- END FEATURES SECTION TITLE -->
            </div>
        </div>
    </div>
</section>
<!-- END FEATURES SECTION -->

<!-- Footer -->
<section class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="copy_right_text">
                    <!-- COPYRIGHT TEXT -->
                    <p>&copy; {{ date('Y') }} {{ setting('site_title') }}. Todos os direitos reservados.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="scroll_top">
                    <a href="#HOME"><i class="fa fa-angle-up"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FOOTER -->

<!-- SCRIPTS -->
<script src="{{ asset('index/js/jquery.min.js') }}"></script>
<script src="{{ asset('index/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('index/js/smoothscroll.js') }}"></script>
<script src="{{ asset('index/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{ asset('index/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ asset('index/js/wow.min.js') }}"></script>
<script src="{{ asset('index/js/waypoints.min') }}.js"></script>
<script src="{{ asset('index/js/script.js') }}"></script>

</body>
</html>
