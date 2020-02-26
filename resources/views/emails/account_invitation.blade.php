@component('mail::message')
    Olá, sua/seu amiga(o) {{ $username }}, convidou você para participar do Haitou 2.0.
    @component('mail::button', ['url' => route('invitations', $code), 'color' => 'blue'])
        Aceitar convite
    @endcomponent
    Este convite expira em: {{ $expire }}.

    Equipe,
    {{ $site_name }}
@endcomponent
