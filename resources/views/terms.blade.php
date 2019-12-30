<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{ setting('site_title') }} :: Termos</title>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicons/favicon.ico') }}">

    <!-- Icons -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Barlow:300,400,500,600,700" rel="stylesheet">

    <!-- CSRF Token -->
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
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
    <!-- END Icons -->

    <!-- Icon fonts -->
    <link href="{{ asset('fonts/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('fonts/linearicons.css') }}" rel="stylesheet">

    <!-- Core stylesheets -->
    <link href="{{ asset('css/index.css') }}" rel="stylesheet">
</head>

<body>
<div class="page-loader">
    <div class="bg-primary"></div>
</div>

<!-- Navbar -->
<nav class="landing-navbar navbar navbar-expand-lg navbar-dark fixed-top pt-lg-4">
    <div class="container-fluid px-3">
        <a href="{{ url('/') }}" class="navbar-brand text-big font-weight-bolder line-height-1 text-expanded py-3">{{ setting('site_title') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#landing-navbar-collapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="landing-navbar-collapse">
            <div class="navbar-nav align-items-lg-center ml-auto">
                @if (Route::has('login'))
                    @auth
                        <div class="nav-item py-2 py-lg-0 ml-lg-1">
                            <a href="{{ route('home') }}" class="btn btn-success rounded-pill">Home</a>
                        </div>
                    @else
                        <div class="nav-item py-2 py-lg-0 ml-lg-4">
                            <a href="{{ route('login') }}" class="btn btn-outline-white rounded-pill borderless">Login</a>
                        </div>
                        @if (Route::has('register'))
                            <div class="nav-item py-2 py-lg-0 ml-lg-1">
                                <a href="{{ route('register') }}" class="btn btn-primary rounded-pill">Cadastre-se</a>
                            </div>
                        @endif
                    @endauth
                @endif
                @if(!empty(setting('discord')))
                    <div class="nav-item py-2 py-lg-0 ml-lg-1">
                        <a href="{{ hideref(setting('discord')) }}" target="_blank" class="btn purple rounded-pill borderless">Discord Chat</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- / Navbar -->

<!-- Header -->
<div class="jumbotron ui-hero ui-mh-100vh ui-bg-cover ui-bg-fixed ui-bg-overlay-container text-white" style="background-image: url('{{ asset('images/index.png') }}');">
    <div class="ui-bg-overlay bg-dark opacity-50"></div>
    <div class="container py-5 px-3">
        <div class="row pt-4">
            <div class="w-100">
                <div class="col-md-11 col-lg-8 col-xl-7 text-center mx-auto mb-5">
                    <h1 class="display-3 font-secondary font-weight-bolder mb-4">{{ setting('site_title') }}</h1>
                    <div class="lead opacity-75">
                        Text text.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- / Header -->

<div class="bg-white">

    <!-- Block -->
    <div class="landing-block pb-5">
        <div class="container px-3">

            <div class="col-md-10 col-lg-8 col-xl-7 text-center p-0 mx-auto">
                <div class="display-3 text-primary mb-4">
                    <i class="lnr lnr-rocket"></i>
                </div>
                <h1 class="display-4 font-secondary font-weight-semibold mb-5">Termos</h1>
                <div class="text-muted">
                    {!! setting('terms') !!}
                </div>
            </div>

        </div>
    </div>
    <!-- / Block -->

</div>

<!-- Footer -->
<nav class="footer bg-lightest pt-4">
    <div class="container text-center py-4">
        <div class="pb-3">
            <span class="align-top">{{ date('Y') }} &copy {{ setting('site_title') }}. Todos os direitos reservados.</span>
        </div>
    </div>
</nav>
<!-- / Footer -->

</body>
</html>
