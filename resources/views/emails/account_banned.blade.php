@component('mail::message')

    Olá, {{ $username }},

    Você sua conta foi banida do {{ $site_name }}.
    Esta proibição é permanente.

    Como resultado deste banimento, você não poderá mais logar no servidor.

    Equipe,
    {{ $site_name }}
@endcomponent
