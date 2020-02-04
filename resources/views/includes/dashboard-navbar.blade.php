<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                <i class="ti-menu ti-close"></i>
            </a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="{{ url('home') }}">
                <!-- Logo icon -->
                <b class="logo-icon">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('images/favicons/android-icon-36x36.png') }}" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo icon -->
                    <img src="{{ asset('images/favicons/android-icon-36x36.png') }}" alt="homepage" class="light-logo"/>
                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="{{ asset('images/favicons/android-icon-36x36.png') }}" alt="homepage" class="dark-logo"/>
                    <!-- Light Logo text -->
                    <img src="{{ asset('images/logo-text.png') }}" class="light-logo" alt="homepage"/>
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
               data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
               aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block">
                    <a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar">
                        <i class="mdi mdi-menu font-24"></i>
                    </a>
                </li>
                <!-- ============================================================== -->
                <!-- create new -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-none d-md-block">Meus Favoritos <i class="fa fa-angle-down"></i></span>
                        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('bookmark.actors') }}">Atrizes/Atores</a>
                        <a class="dropdown-item" href="{{ route('bookmark.characters') }}">Personagens</a>
                        <a class="dropdown-item" href="{{ route('bookmark.medias') }}">Mídias</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box">
                    <a class="nav-link waves-effect waves-dark" href="javascript:void(0)">
                        <i class="ti-search"></i>
                    </a>
                    {!! Form::open(['url' => 'search', 'class' => 'app-search position-absolute']) !!}
                        {!! Form::text('search', null, ['class' => 'form-control', 'placeholder' => 'Pesquisar...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                    {!! Form::close() !!}
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                @if(auth()->user()->unreadNotifications()->count() > 0)
                <li class="nav-item dropdown">
                    <a class="nav-link waves-effect waves-dark" href="{{ route('notifications.index') }}" aria-haspopup="true" aria-expanded="false">
                        <span class="far fa-dot-circle text-danger"></span>
                        <i class="mdi mdi-bell font-24 text-success align-middle"></i>
                    </a>
                </li>
                @endif
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar() }}" alt="user" class="img-rounded" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class="">
                                <img src="{{ auth()->user()->avatar() }}" alt="user" class="img-circle" width="60">
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">{{ auth()->user()->username }}</h4>
                                <p class="m-b-0">{{ auth()->user()->groupName() }}</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{ url('achievements') }}">
                            <i class="ion ion-ios-trophy text-lightest m-r-5 m-l-5"></i> Conquistas
                        </a>
                        <a class="dropdown-item" href="{{ route('notifications.index') }}">
                            <i class="ion ion-md-notifications-outline text-lightest m-r-5 m-l-5"></i> Notificações
                        </a>
                        <a class="dropdown-item" href="{{ url('user/edit/account') }}">
                            <i class="ion ion-md-settings text-lightest m-r-5 m-l-5"></i> Editar conta
                        </a>
                        <a class="dropdown-item" href="{{ url('lockscreen') }}">
                            <i class="ion ion-md-lock text-lightest m-r-5 m-l-5"></i> Bloquear Tela
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-top').submit();">
                            <i class="fa fa-power-off m-r-5 m-l-5 text-danger"></i> Sair
                        </a>
                        {!! Form::open(['url' => 'logout', 'id' => 'logout-top', 'style' => 'display: none']) !!}
                        {!! Form::close() !!}
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
<!-- ============================================================== -->
<!-- End Topbar header -->
<!-- ============================================================== -->
