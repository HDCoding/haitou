<ul class="nav container-m-nx bg-lighter container-p-x m-b-4">
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/fontawesome') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/fontawesome') }}">
            <i class="fas fa-font-awesome-flag"></i>
            Font Awesome 5
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/ionicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/ionicons') }}">
            <i class="ion ion-logo-ionic"></i>
            Ionicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/linearicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/linearicons') }}">
            <i class="lnr lnr-linearicons"></i>
            Linearicons
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/openiconic') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/openiconic') }}">
            <i class="oi oi-heart"></i>
            Open Iconic
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->is('staff/icons/strokeicons') ? 'text-body font-weight-bold pl-0' : 'text-muted' }}" href="{{ url('staff/icons/strokeicons') }}">
            <i class="pe-7s-box2"></i>
            Stroke Icons 7
        </a>
    </li>
</ul>
