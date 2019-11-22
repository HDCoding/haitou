@component('mail::message')
    Bem-vinda(o)
    @component('mail::button', ['url' => route('new.activation', $code), 'color' => 'blue'])
        Ativar conta
    @endcomponent
@endcomponent
