@component('mail::message')
    Olá!

    Obrigado por criar uma conta do {{ config('app.name') }}. Você está pronta(o) para prosseguir!

    {{ config('app.name') }} torna mais fácil para o torrent/fórum e usuários.
    Acompanhe as conversas em tempo real com as quais eles se importam. Traz mais flexibilidade
    e insight para os usuários, acompanhe as pessoas e os tópicos mais importantes para você.
    E você pode participar da conversas, compartilhando fotos e links para o site.
    tópicos de notícias e muito mais.

    Para mais informações sobre {{ config('app.name') }}, incluindo downloads e links.
    Por favor leia a página de Regras e F.A.Q. para qualquer dúvida.

    Equipe,
    {{ config('app.name') }}

@endcomponent