<ul class="nav container-m-nx bg-lighter container-p-x m-b-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/fontawesome') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/fontawesome') }}">
            <span class="fab fa-font-awesome-flag"></span>
            Font Awesome 5
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/ionicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/ionicons') }}">
            <span class="ion ion-logo-ionic"></span>
            Ionicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/linearicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/linearicons') }}">
            <span class="lnr lnr-linearicons"></span>
            Linearicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/openiconic') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/openiconic') }}">
            <span class="oi oi-heart"></span>
            Open Iconic
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/strokeicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/strokeicons') }}">
            <span class="pe-7s-box2"></span>
            Stroke Icons 7
        </a>
    </li>
</ul>
