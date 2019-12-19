<!-- ============================================================== -->
<!-- Topbar header - style you can find in pages.scss -->
<!-- ============================================================== -->
<header class="topbar">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
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
                    <img src="{{ asset('images/favicons/android-icon-36x36.png') }}" class="light-logo" alt="homepage"/>
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
                        <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
                        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
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
                <!-- ============================================================== -->
                <!-- Comment -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-bell font-24"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <ul class="list-style-none">
                            <li>
                                <div class="drop-title bg-primary text-white">
                                    <h4 class="m-b-0 m-t-5">4 New</h4>
                                    <span class="font-light">Notifications</span>
                                </div>
                            </li>
                            <li>
                                <div class="message-center notifications">
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Luanch Admin</h5>
                                            <span class="mail-desc">Just see the my new admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Event today</h5>
                                            <span class="mail-desc">Just a reminder that you have event</span>
                                            <span class="time">9:10 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Settings</h5>
                                            <span class="mail-desc">You can customize this template as you want</span>
                                            <span class="time">9:08 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:02 AM</span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center m-b-5" href="javascript:void(0);">
                                    <strong>Check all notifications</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Comment -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="font-24 mdi mdi-comment-processing"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                        <span class="with-arrow"><span class="bg-danger"></span></span>
                        <ul class="list-style-none">
                            <li>
                                <div class="drop-title text-white bg-danger">
                                    <h4 class="m-b-0 m-t-5">5 New</h4>
                                    <span class="font-light">Messages</span>
                                </div>
                            </li>
                            <li>
                                <div class="message-center message-body">
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="user-img">
                                            <img src="{{ asset('images/avatar.jpg') }}" alt="user" class="rounded-circle">
                                            <span class="profile-status online pull-right"></span>
                                        </span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:30 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="user-img">
                                            <img src="{{ asset('images/avatar.jpg') }}" alt="user" class="rounded-circle">
                                            <span class="profile-status busy pull-right"></span>
                                        </span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Sonu Nigam</h5>
                                            <span class="mail-desc">I've sung a song! See you at</span>
                                            <span class="time">9:10 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="user-img">
                                            <img src="{{ asset('images/avatar.jpg') }}" alt="user" class="rounded-circle">
                                            <span class="profile-status away pull-right"></span>
                                        </span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Arijit Sinh</h5>
                                            <span class="mail-desc">I am a singer!</span>
                                            <span class="time">9:08 AM</span>
                                        </span>
                                    </a>
                                    <!-- Message -->
                                    <a href="javascript:void(0)" class="message-item">
                                        <span class="user-img">
                                            <img src="{{ asset('images/avatar.jpg') }}" alt="user" class="rounded-circle">
                                            <span class="profile-status offline pull-right"></span>
                                        </span>
                                        <span class="mail-contnet">
                                            <h5 class="message-title">Pavan kumar</h5>
                                            <span class="mail-desc">Just see the my admin!</span>
                                            <span class="time">9:02 AM</span>
                                        </span>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="nav-link text-center link" href="javascript:void(0);">
                                    <b>See all e-Mails</b>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{ auth()->user()->avatar() }}" alt="user" class="rounded-circle" width="31">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <span class="with-arrow"><span class="bg-primary"></span></span>
                        <div class="d-flex no-block align-items-center p-15 bg-primary text-white m-b-10">
                            <div class="">
                                <img src="{{ auth()->user()->avatar() }}" alt="user" class="img-circle" width="60">
                            </div>
                            <div class="m-l-10">
                                <h4 class="m-b-0">{{ auth()->user()->username }}</h4>
                                <p class="m-b-0">{{ auth()->user()->group->name }}</p>
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
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off m-r-5 m-l-5 text-danger"></i> Sair
                        </a>
                        {!! Form::open(['url' => 'logout', 'id' => 'logout-form', 'style' => 'display: none']) !!}
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
