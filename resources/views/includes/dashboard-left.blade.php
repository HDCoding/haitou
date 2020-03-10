<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- Home -->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('home') }}" aria-expanded="false"><i class="ion ion-ios-rocket"></i><span class="hide-menu">Home</span></a></li>
                <!-- End Home -->
				<!-- Menu -->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Menu</span></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('bonus') }}" aria-expanded="false"><i class="fas fa-book-medical"></i><span class="hide-menu">Bônus</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('invites') }}" aria-expanded="false"><i class="far fa-envelope"></i><span class="hide-menu">Convites</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('chatbox') }}" aria-expanded="false"><i class="fab fa-rocketchat"></i><span class="hide-menu">Chat</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('fansubs') }}" aria-expanded="false"><i class="ion ion-md-people"></i><span class="hide-menu">Fansubs</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('forum') }}" aria-expanded="false"><i class="far fa-comments"></i><span class="hide-menu">Fórum</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('polls') }}" aria-expanded="false"><i class="fas fa-poll"></i><span class="hide-menu">Pesquisas</span></a></li>
                <!-- End Menu -->
				<!-- Profissional -->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Profissional</span></li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ion ion-logo-buffer"></i><span class="hide-menu">Torrents</span></a>
                    <ul aria-expanded="false" class="collapse  first-level">
                        <li class="sidebar-item"><a href="{{ url('torrents') }}" class="sidebar-link"><i class="mdi mdi-layers"></i><span class="hide-menu">Torrents</span></a></li>
                        @can('upload-torrent')
                        <li class="sidebar-item"><a href="{{ url('torrents/create') }}" class="sidebar-link"><i class="mdi mdi-credit-card-scan"></i><span class="hide-menu">Upload</span></a></li>
                        @endcan
                        <li class="sidebar-item"><a href="{{ route('torrent.uploads') }}" class="sidebar-link"><i class="fas fa-upload"></i><span class="hide-menu">Meus Uploads</span></a></li>
                        <li class="sidebar-item"><a href="{{ route('torrent.downloads') }}" class="sidebar-link"><i class="fas fa-download"></i><span class="hide-menu">Meus Downloads</span></a></li>
                    </ul>
                </li>
                <!-- End Profissional -->
                <!-- Others -->
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('calendars') }}" aria-expanded="false"><i class="fas fa-calendar-alt"></i><span class="hide-menu">Calendário</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('donates') }}" aria-expanded="false"><i class="ion ion-md-star"></i><span class="hide-menu">Doação</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('freeslots') }}" aria-expanded="false"><i class="fas fa-chart-line"></i><span class="hide-menu">Free Slots</span></a></li>
                <!-- End Others -->
                <!-- Support -->
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Suporte</span></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('faq') }}" aria-expanded="false"><i class="far fa-question-circle"></i><span class="hide-menu">F.A.Q</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('rules') }}" aria-expanded="false"><i class="pe-7s-news-paper"></i><span class="hide-menu">Regras</span></a></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('statistics') }}" aria-expanded="false"><i class="fa fa-chart-bar"></i><span class="hide-menu">Estatísticas</span></a></li>
                <!-- End Support -->
				<!-- Staff Panel -->
                @can('painel-staff')
                <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Dashboard</span></li>
                <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="{{ url('staff') }}" aria-expanded="false"><i class="fab fa-fort-awesome"></i><span class="hide-menu">Painel Staff</span></a></li>
                @endcan
                <!-- End Staff Panel -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
