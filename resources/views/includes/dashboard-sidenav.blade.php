<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">

    <!-- Brand demo (see css/demo.css) -->
    <div class="app-brand demo">
          <span class="app-brand-logo demo bg-white">
            <img src="{{ asset('images/favicons/apple-icon-60x60.png') }}" alt="Logo">
          </span>
        <a href="#" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Site Nome</a>
        <a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>

    <div class="sidenav-divider mt-0"></div>

    <!-- Links -->
    <ul class="sidenav-inner py-1">

        <!-- Home -->
        <li class="sidenav-item open active">
            <a href="{{ url('home') }}" class="sidenav-link">
                <i class="sidenav-icon ion ion-ios-rocket"></i>
                <div>Home</div>
            </a>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">MENU</li>

        <!-- MENU -->
        <li class="sidenav-item {{ ative_page('chatbox') }}">
            <a href="{{ url('chatbox') }}" class="sidenav-link">
                <i class="sidenav-icon fab fa-rocketchat"></i>
                <div>Chat</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('forum/*') }}">
            <a href="{{ url('forum') }}" class="sidenav-link">
                <i class="sidenav-icon far fa-comments"></i>
                <div>@lang('dashboard.forums')</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('invites') }}">
            <a href="{{ url('invites') }}" class="sidenav-link">
                <i class="sidenav-icon far fa-envelope"></i>
                <div>Convites</div>
                <div class="pl-1 ml-auto">
                    <div class="badge badge-primary">
{{--                        {{ auth()->user()->invites }}--}}
                    </div>
                </div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('fansubs') }}">
            <a href="{{ url('fansubs') }}" class="sidenav-link">
                <i class="sidenav-icon ion ion-md-people"></i>
                <div>@lang('dashboard.fansubs')</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('bonus') }}">
            <a href="{{ url('bonus') }}" class="sidenav-link">
                <i class="sidenav-icon fas fa-book-medical"></i>
                <div>@lang('dashboard.bonus')</div>
            </a>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">PROFISSIONAL</li>

        <li class="sidenav-item {{ ative_page('torrents/*') }}">
            <a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon ion ion-logo-buffer"></i>
                <div>Torrent</div>
            </a>

            <ul class="sidenav-menu">
                <li class="sidenav-item {{ ative_page('torrents') }}">
                    <a href="{{ url('torrents') }}" class="sidenav-link">
                        <div>@lang('dashboard.torrents')</div>
                    </a>
                </li>
{{--                @if(auth()->user()->permission->torrents_upload)--}}
                    <li class="sidenav-item {{ ative_page('torrents/create') }}">
                        <a href="{{ url('torrents/create') }}" class="sidenav-link">
                            <div>Upload</div>
                        </a>
                    </li>
{{--                @endif--}}
            </ul>
        </li>

        <li class="sidenav-item {{ ative_page('calendars') }}">
            <a href="{{ url('calendars') }}" class="sidenav-link">
                <i class="sidenav-icon fas fa-calendar-alt"></i>
                <div>@lang('dashboard.calendars')</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('donates') }}">
            <a href="{{ url('donates') }}" class="sidenav-link">
                <i class="sidenav-icon ion ion-md-star"></i>
                <div>Doação</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('freeslots') }}">
            <a href="{{ url('freeslots') }}" class="sidenav-link">
                <i class="sidenav-icon fas fa-chart-line"></i>
                <div>@lang('dashboard.freeslots')</div>
            </a>
        </li>

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">SUPORTE</li>

        <li class="sidenav-item {{ ative_page('faqs') }}">
            <a href="{{ url('faqs') }}" class="sidenav-link">
                <i class="sidenav-icon far fa-question-circle"></i>
                <div>@lang('dashboard.faqs')</div>
            </a>
        </li>

        <li class="sidenav-item {{ ative_page('rules') }}">
            <a href="{{ url('rules') }}" class="sidenav-link">
                <i class="sidenav-icon pe-7s-news-paper"></i>
                <div>@lang('dashboard.rules')</div>
            </a>
        </li>

{{--        @if(auth()->user()->permission->staff_panel)--}}
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold text-uppercase">@lang('dashboard.title')</li>

            <li class="sidenav-item {{ ative_page('staff') }}">
                <a href="{{ url('staff') }}" class="sidenav-link">
                    <i class="sidenav-icon fab fa-fort-awesome"></i>
                    <div>@lang('dashboard.title')</div>
                </a>
            </li>
{{--        @endif--}}

    </ul>
</div>
