@extends('layouts.indexes')

@section('styles')
    <link href="{{ asset('css/pages/landing.css') }}" rel="stylesheet">
    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/linearicons.css') }}">
@endsection

@section('content')

    <!-- Navbar -->
    <nav class="landing-navbar navbar navbar-expand-lg navbar-dark fixed-top pt-lg-4">
        <div class="container-fluid px-3">
            <a href="{{ url('/') }}" class="navbar-brand text-big font-weight-bolder line-height-1 text-expanded py-3">
                site_title
            </a>

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
                                <a href="{{ route('login') }}" class="btn btn-outline-white rounded-pill borderless">
                                    Login
                                </a>
                            </div>
                            @if (Route::has('register'))
                                <div class="nav-item py-2 py-lg-0 ml-lg-1">
                                    <a href="{{ route('register') }}" class="btn btn-primary rounded-pill">
                                        Cadastre-se
                                    </a>
                                </div>
                            @endif
                        @endauth
                    @endif
{{--                    @if(!empty(setting()->discord))--}}
                        <div class="nav-item py-2 py-lg-0 ml-lg-1">
                            <a href="#" target="_blank" class="btn discord text-white rounded-pill borderless">
                                Discord Chat
                            </a>
                        </div>
{{--                    @endif--}}
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
                        <h1 class="display-3 font-secondary font-weight-bolder mb-4">site_title</h1>
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
                    <h1 class="display-4 font-secondary font-weight-semibold mb-5">
                        Ultimate Tool for Professionals
                    </h1>
                    <div class="text-muted">
                        Lorem ipsum dolor sit amet, ad eam consul vituperata. Cum assum inimicus an, his ne liber aeterno debitis. Te his iudico tollit efficiendi. Eu harum volumus pri, oporteat probatus disputationi id his. Mei in vidit mollis mediocrem, cum ad suas democritum,
                        ea eos e ligendi nominati volutpat.
                    </div>
                </div>

            </div>
        </div>
        <!-- / Block -->

    </div>

    <!-- Block -->
    <div id="features" class="landing-block">
        <div class="container px-3">

            <div class="col-md-10 col-lg-8 col-xl-7 text-center p-0 mx-auto">
                <div class="text-lighter text-tiny font-weight-bold mb-3">FEATURES</div>
                <h1 class="display-4 font-secondary font-weight-semibold mb-4">
                    Tudo o que você precisa em um site
                </h1>
                <div class="lead text-muted mb-5">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sed interdum lorem, non hendrerit lectus. Suspendisse ultricies lobortis vulputate.
                </div>
            </div>

            <hr class="landing-separator border-light mx-auto">

            <div class="row text-center">
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-star"></span>
                    </div>
                    <h5>Dapibus ac facilisis in</h5>
                    <div class="text-muted small">
                        Lorem ipsum dolor sit amet, ius virtute suscipit te. Ius prima euismod consequat eu, cu quo alii scriptorem
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-picture"></span>
                    </div>
                    <h5>Cras justo odio</h5>
                    <div class="text-muted small">
                        Etiam vivendo eu sea, purto ponderum mediocritatem at pro. Ex tantas invenire dissentiunt mea.
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-calendar-full"></span>
                    </div>
                    <h5>Porta ac consectetur ac</h5>
                    <div class="text-muted small">
                        Iuvaret deleniti vulputate nec ne, id vix lucilius legendos deseruisse, harum honestatis cum te.
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-camera"></span>
                    </div>
                    <h5>Nullam lobortis</h5>
                    <div class="text-muted small">
                        Praesent massa quam, luctus et efficitur congue, aliquam quis quam. In tellus quam, ornare et consectetur ut, ullamcorper vitae nunc.
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-pie-chart"></span>
                    </div>
                    <h5>Quisque dictum magna</h5>
                    <div class="text-muted small">
                        Curabitur rutrum eleifend urna, sit amet iaculis metus consequat at. Pellentesque id accumsan leo.
                    </div>
                </div>
                <div class="col-md-4 mt-5">
                    <div class="display-4 text-primary mx-auto mb-4">
                        <span class="lnr lnr-layers"></span>
                    </div>
                    <h5>Suspendisse facilisis laoreet</h5>
                    <div class="text-muted small">
                        Curabitur tristique in elit in fermentum. Sed pellentesque ullamcorper risus pellentesque finibus.
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- / Block -->

    <!-- Block -->
    <div id="subscribe" class="bg-secondary text-white py-5">
        <div class="container px-3">
            <div class="row align-items-center">

                <div class="font-secondary col-md-5 col-lg-4 text-xlarge font-weight-light">
                    AVISO LEGAL
                </div>

                <div class="col-md-7 col-lg-8 mt-3 mt-md-0">

                </div>

            </div>
        </div>
    </div>
    <!-- / Block -->

    <!-- Footer -->
    <nav class="footer bg-lightest pt-4">
        <div class="container text-center py-4">
            <div class="pb-3">
                <span class="align-top">{{ date('Y') }} &copy site_title. Todos os direitos reservados.</span>
            </div>
        </div>
    </nav>
    <!-- / Footer -->

@endsection
