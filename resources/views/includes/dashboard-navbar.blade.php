<nav class="layout-navbar navbar navbar-expand-lg align-items-lg-center bg-white container-p-x" id="layout-navbar">

    <!-- Brand demo (see css/demo.css) -->
    <a href="{{ url('home') }}" class="navbar-brand app-brand demo d-lg-none py-0 mr-4">
        <span class="app-brand-logo demo bg-primary">
            <img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="Logo">
        </span>
        <span class="app-brand-text demo font-weight-normal ml-2">Site Nome</span>
    </a>

    <!-- Sidenav toggle (see assets/css/demo/demo.css) -->
    <div class="layout-sidenav-toggle navbar-nav d-lg-none align-items-lg-center mr-auto">
        <a class="nav-item nav-link px-0 mr-lg-4" href="javascript:void(0)">
            <i class="ion ion-md-menu text-large align-middle"></i>
        </a>
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#layout-navbar-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="layout-navbar-collapse">
        <!-- Divider -->
        <hr class="d-lg-none w-100 my-2">

        <div class="navbar-nav align-items-lg-center">
            <!-- Search -->
            <label class="nav-item navbar-text navbar-search-box p-0 active">
                <i class="ion ion-ios-search navbar-icon align-middle"></i>
                <span class="navbar-search-input pl-2">
                    {!! Form::open(['url' => 'search']) !!}
                    {!! Form::text('query', null, ['class' => 'form-control navbar-text mx-2', 'placeholder' => 'Pesquisar...', 'required', 'style' => 'width:300px']) !!}
                    {!! Form::close() !!}
                </span>
            </label>
        </div>

        <div class="navbar-nav align-items-lg-center ml-auto">
            <div class="demo-navbar-notifications nav-item dropdown mr-lg-3">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown">
                    <i class="ion ion-md-notifications-outline navbar-icon align-middle"></i>
                    <span class="badge badge-primary badge-dot indicator"></span>
                    <span class="d-lg-none align-middle">&nbsp; Notificações</span>
                </a>

            </div>

            <div class="demo-navbar-messages nav-item dropdown mr-lg-3" id="hover-dropdown-demo">
                <a class="nav-link dropdown-toggle hide-arrow" href="#" data-toggle="dropdown" data-trigger="hover" aria-expanded="false">
                    <i class="ion ion-ios-person navbar-icon align-middle"></i>
                    @if(auth()->user()->is_warned)
                        <span class="badge badge-danger badge-dot indicator"></span>
                    @endif
                    <span class="d-lg-none align-middle">&nbsp; Perfil</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="width: 18rem">
                    <div class="bg-primary text-center text-white font-weight-bold p-3">
                        Status
                    </div>
                    <div class="list-group list-group-flush">

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ asset('images/status/uploaded.png') }}" class="d-block ui-w-40 rounded-circle" alt="Uploaded">
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->uploaded() }}</div>
                                <div class="text-light small mt-1">Upload</div>
                            </div>
                        </a>

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ asset('images/status/downloaded.png') }}" class="d-block ui-w-40 rounded-circle" alt>
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->downloaded() }}</div>
                                <div class="text-light small mt-1">Download</div>
                            </div>
                        </a>

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ asset('images/status/ratio.png') }}" class="d-block ui-w-40 rounded-circle" alt>
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->ratio() }}</div>
                                <div class="text-light small mt-1">Ratio</div>
                            </div>
                        </a>

                        @if(auth()->user()->is_warned)
                            <a href="javascript:void(0)"
                               class="list-group-item list-group-item-action media d-flex align-items-center">
                                <img src="{{ asset('images/status/warned.png') }}" class="d-block ui-w-40" alt>
                                <div class="media-body ml-3">
                                    <div class="text-body line-height-condenced">
                                        Regularize antes de uma uma suspensão ou banimento.
                                    </div>
                                    <div class="text-light small mt-1">Advertência</div>
                                </div>
                            </a>
                        @endif

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ asset('images/status/heart.png') }}" class="d-block ui-w-40 rounded-circle" alt>
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->points() }}</div>
                                <div class="text-light small mt-1">Pontos</div>
                            </div>
                        </a>

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ auth()->user()->levelImage() }}" class="d-block ui-w-40" alt>
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->level() }}</div>
                                <div class="text-light small mt-1">Level</div>
                            </div>
                        </a>

                        <a href="javascript:void(0)"
                           class="list-group-item list-group-item-action media d-flex align-items-center">
                            <img src="{{ asset('images/avatar.jpg') }}" class="d-block ui-w-40 rounded-circle" alt="Grupo">
                            <div class="media-body ml-3">
                                <div class="text-body line-height-condenced">{{ auth()->user()->groupName() }}</div>
                                <div class="text-light small mt-1">Grupo</div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>

            <!-- Divider -->
            <div class="nav-item d-none d-lg-block text-big font-weight-light line-height-1 opacity-25 mr-3 ml-1">|</div>

            <div class="demo-navbar-user nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
                  <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                    <img src="{{ auth()->user()->avatar() }}" alt class="d-block ui-w-30 rounded-circle">
                    <span class="px-1 mr-lg-2 ml-2 ml-lg-0">{{ auth()->user()->username }}</span>
                  </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('achievements') }}" class="dropdown-item">
                        <i class="ion ion-ios-trophy text-lightest"></i> &nbsp; Conquistas
                    </a>
                    <a href="{{ route('notifications.index') }}" class="dropdown-item">
                        <i class="ion ion-md-notifications-outline text-lightest"></i> &nbsp; Notificações
                    </a>
                    <a href="{{ url('user/edit/account') }}" class="dropdown-item">
                        <i class="ion ion-md-settings text-lightest"></i> &nbsp; Editar conta
                    </a>
                    <a href="{{ url('lockscreen') }}" class="dropdown-item">
                        <i class="ion ion-md-lock text-lightest"></i> &nbsp; Bloquear Tela
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-toggle">
                        <div class="dropdown-item">Meus Favoritos</div>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('bookmark.actors') }}">Atrizes/Atores</a>
                            <a class="dropdown-item" href="{{ route('bookmark.characters') }}">Personagens</a>
                            <a class="dropdown-item" href="{{ route('bookmark.medias') }}">Mídias</a>
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('torrent.uploads') }}" class="dropdown-item">
                        <i class="fas fa-upload text-lightest"></i> &nbsp; Meus Uploads
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ion ion-ios-log-out text-danger"></i> &nbsp; Sair
                    </a>
                    {!! Form::open(['url' => 'logout', 'id' => 'logout-form', 'style' => 'display: none']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</nav>
