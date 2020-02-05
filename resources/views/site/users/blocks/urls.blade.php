<ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ active_page('user/'.$member->slug.'/profile') }}" href="{{ route('user.profile', ['slug' => $member->slug]) }}" role="tab">Perfil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ active_page('user/'.$member->slug.'/achievements') }}" href="{{ route('user.achievements', ['slug' => $member->slug]) }}">Conquistas</a>
    </li>
    @if(auth()->user()->can('acesso-total'))
    <li class="nav-item">
        <a class="nav-link {{ active_page('user/'.$member->slug.'/logs') }}" href="{{ route('user.logs', ['slug' => $member->slug]) }}">Logs</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ active_page('user/'.$member->slug.'/logins') }}" href="{{ route('user.logins', ['slug' => $member->slug]) }}">Logins</a>
    </li>
    @endif
</ul>
