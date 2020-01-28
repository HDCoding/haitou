<ul class="nav nav-tabs">
    <li class="nav-item"> <a class="nav-link {{ ative_page('statistics/torrent/seeded') }}" href="{{ route('stats.seeded') }}"><span class="hidden-sm-up"><i class="fas fa-upload"></i></span> <span class="hidden-xs-down">Top Seeded</span></a> </li>
    <li class="nav-item"> <a class="nav-link {{ ative_page('statistics/torrent/leeched') }}" href="{{ route('stats.leeched') }}"><span class="hidden-sm-up"><i class="fas fa-download"></i></span> <span class="hidden-xs-down">Top Leeched</span></a> </li>
    <li class="nav-item"> <a class="nav-link {{ ative_page('statistics/torrent/completed') }}" href="{{ route('stats.completed') }}"><span class="hidden-sm-up"><i class="fas fa-arrow-up"></i></span> <span class="hidden-xs-down">Top Completed</span></a> </li>
    <li class="nav-item"> <a class="nav-link {{ ative_page('statistics/torrent/dying') }}" href="{{ route('stats.dying') }}"><span class="hidden-sm-up"><i class="fas fa-exclamation-triangle"></i></span> <span class="hidden-xs-down">Top Dying</span></a> </li>
    <li class="nav-item"> <a class="nav-link {{ ative_page('statistics/torrent/dead') }}" href="{{ route('stats.dead') }}"><span class="hidden-sm-up"><i class="fas fa-recycle"></i></span> <span class="hidden-xs-down">Top Dead</span></a> </li>
</ul>
