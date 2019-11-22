@component('mail::message')
    Você trocou o email cadastrado e por isso precisa ativar sua conta novamente.
    @component('mail::button', ['url' => route('update.activation', $code), 'color' => 'blue'])
        Re-Ativar conta
    @endcomponent
@endcomponent
