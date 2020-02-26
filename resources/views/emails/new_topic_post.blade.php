@component('mail::message')

Olá {{ $username }},

Você recebeu este email porque você monitoriza o tópico "{{ $topic_name }}".
O tópico recebeu uma resposta desde a sua última visita.

Ao clicar no link, você poderá visualizar as respostas que foram feitas.
Nenhuma outra notificação será enviada antes que você visite o tópico.

{{ $link }}

@component('mail::button', ['url' => url($link), 'color' => 'blue', 'target' => '_blank'])
    Acessar link
@endcomponent

--

{{ $site_name }}
@endcomponent
