<ul class="nav container-m-nx bg-lighter container-p-x mb-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/fontawesome') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/fontawesome') }}">
            <span class="fab fa-font-awesome-flag"></span>
            Font Awesome 5
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/ionicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/ionicons') }}">
            <span class="ion ion-logo-ionic"></span>
            Ionicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/linearicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/linearicons') }}">
            <span class="lnr lnr-linearicons"></span>
            Linearicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/open-iconic') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/open-iconic') }}">
            <span class="oi oi-heart"></span>
            Open Iconic
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/stroke-icons-7') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/stroke-icons-7') }}">
            <span class="pe-7s-box2"></span>
            Stroke Icons 7
        </a>
    </li>
</ul>
