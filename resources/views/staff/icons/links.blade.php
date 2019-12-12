<ul class="nav container-m-nx bg-lighter container-p-x m-b-4">
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
        <a class="nav-link {{ request()->is('staff/icon/openiconic') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/openiconic') }}">
            <span class="oi oi-heart"></span>
            Open Iconic
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icon/strokeicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icon/strokeicons') }}">
            <span class="pe-7s-box2"></span>
            Stroke Icons 7
        </a>
    </li>
</ul>
