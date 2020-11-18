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

    <title>{{ setting('site_title') }}</title>

    <!-- Favicons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ secure_asset('images/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="icon" type="image/x-icon" href="{{ secure_asset('images/favicons/favicon.ico') }}">

    <link rel="shortcut icon" href="{{ secure_asset('images/favicons/favicon.png') }}">

    <link rel="icon" type="image/png" href="{{ secure_asset('images/favicons/favicon-16x16.png') }}" sizes="16x16">
    <link rel="icon" type="image/png" href="{{ secure_asset('images/favicons/favicon-32x32.png') }}" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ secure_asset('images/favicons/favicon-96x96.png') }}" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ secure_asset('images/favicons/ms-icon-150x150.png') }}" sizes="150x150">
    <link rel="icon" type="image/png" href="{{ secure_asset('images/favicons/android-icon-192x192.png') }}" sizes="192x192">

    <link rel="manifest" href="{{ secure_asset('images/favicons/manifest.json') }}">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ secure_asset('images/favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ secure_asset('images/favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ secure_asset('images/favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ secure_asset('images/favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ secure_asset('images/favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ secure_asset('images/favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ secure_asset('images/favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ secure_asset('images/favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ secure_asset('images/favicons/apple-icon-180x180.png') }}">
    <!-- END Favicons -->

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- Bootstrap -->
    <link href="{{ secure_asset('index/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Pixeden Icon Font -->
    <link href="{{ secure_asset('fonts/pe-icon-7-stroke.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{ secure_asset('fonts/fontawesome.css') }}" rel="stylesheet">

    <!-- Style -->
    <link href="{{ secure_asset('index/css/style.css') }}" rel="stylesheet">

    <link href="{{ secure_asset('index/css/animate.css') }}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{ secure_asset('index/css/responsive.css') }}" rel="stylesheet">
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
                        <img src="{{ secure_asset('images/logo-text.png') }}" alt="Logo" width="140">
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
                        <img width="150" height="75" src="{{ secure_asset('images/logo-index.png') }}" alt="">
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
                                    <a href="{{ route('home') }}" class="btn home-btn wow fadeInRight">Home</a>
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
                    <h2>Recursos</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip.
                    </p>
                </div>
                <!-- END FEATURES SECTION TITLE -->
            </div>
        </div>
    </div>

    <div class="feature_inner">
        <div class="container">
            <div class="row">
                <div class="col-md-4 right_no_padding wow fadeInLeft" data-wow-duration="1s">
                    <!-- FEATURE -->
                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-like"></span></div>
                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>Design criativo<span>/</span></h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                    <!-- FEATURE -->
                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-science"></span></div>

                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>Aparência moderna<span>/</span></h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                    <!-- FEATURE -->
                    <div class="left_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-look"></span></div>
                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3>Layout mínimo<span>/</span></h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                </div>
                <div class="col-md-4">
                    <div class="feature_iphone">
                        <!-- FEATURE PHONE IMAGE -->
                        <!-- image copyright: https://www.deviantart.com/thekarmaking/art/Kizuna-Ai-fanart-render-763435974 -->
                        <img class="wow bounceIn" data-wow-duration="1s" src="{{ secure_asset('images/index-resource.png')  }}" alt="">
                    </div>
                </div>
                <div class="col-md-4 left_no_padding wow fadeInRight" data-wow-duration="1s">
                    <!-- FEATURE -->
                    <div class="right_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-monitor"></span></div>
                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3><span>/</span>Texto</h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                    <!-- FEATURE -->
                    <div class="right_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-phone"></span></div>
                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3><span>/</span>Responsivo</h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->

                    <!-- FEATURE -->
                    <div class="right_single_feature">
                        <!-- ICON -->
                        <div><span class="pe-7s-gleam"></span></div>
                        <!-- FEATURE HEADING AND DESCRIPTION -->
                        <h3><span>/</span>Código Limpo</h3>
                        <p>Lorem ipsum dolor, consectetur sed do adipisicing elit, sed do eiusmod tempor incididunt</p>
                    </div>
                    <!-- END SINGLE FEATURE -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END FEATURES SECTION -->



<!-- START CALL TO ACTION -->
<div class="call_to_action">
    <div class="container">
        <div class="row wow fadeInLeftBig" data-wow-duration="1s">
            <div class="col-md-9">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore
                    et olore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip.
                </p>
            </div>
            <div class="col-md-3">
                <a class="btn btn-primary btn-action" href="#" role="button">Cadastre-se Agora</a>
            </div>
        </div>
    </div>
</div>
<!-- END CALL TO ACTION -->

<!-- START CONTCT FORM AREA -->
<section class="contact page" id="CONTACT">
    <div class="section_overlay">
        <div class="container">
            <div class="col-md-10 col-md-offset-1 wow bounceIn">
                <!-- Start Contact Section Title-->
                <div class="section_title">
                    <h2>Entre em contato</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi ut aliquip.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END CONTACT -->

@if(!empty(setting('disclaimer')))
<section class="subscribe parallax subscribe-parallax" data-stellar-background-ratio="0.6" data-stellar-vertical-offset="20">
    <div class="section_overlay wow lightSpeedIn">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <!-- Start Subscribe Section Title -->
                    <div class="section_title">
                        <h2>Aviso Legal</h2>
                        <p>{!! setting('disclaimer') !!}</p>
                    </div>
                    <!-- End Subscribe Section Title -->
                </div>
            </div>
        </div>
    </div>
</section>
@endif

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
<script src="{{ secure_asset('index/js/jquery.min.js') }}"></script>
<script src="{{ secure_asset('index/js/bootstrap.min.js') }}"></script>
<script src="{{ secure_asset('index/js/smoothscroll.js') }}"></script>
<script src="{{ secure_asset('index/js/jquery.parallax-1.1.3.js') }}"></script>
<script src="{{ secure_asset('index/js/jquery.prettyPhoto.js') }}"></script>
<script src="{{ secure_asset('index/js/wow.min.js') }}"></script>
<script src="{{ secure_asset('index/js/waypoints.min') }}.js"></script>
<script src="{{ secure_asset('index/js/script.js') }}"></script>

</body>
</html>
