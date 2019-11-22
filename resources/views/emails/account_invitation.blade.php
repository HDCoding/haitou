@component('mail::message')
    Olá, sua/seu amiga(o) {{ $username }}, te convivou para participar do nosso site.
    @component('mail::button', ['url' => route('invitations', $code), 'color' => 'blue'])
        Aceitar convite
    @endcomponent
    Este convite expira em: {{ $expire }}.

    Equipe,
    {{ config('app.name') }}
@endcomponent
