@extends('layouts.dashboard')

@section('subtitle', 'Convites')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <span class="text-muted font-weight-light">Convites</span>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <div class="card-title with-elements">
                <h5 class="m-0 mr-2">Convidar</h5>
            </div>
            @includeIf('errors.errors', [$errors])
            @include('includes.messages')
            <div class="block">
                <div class="block-header">
                    <p class="text-muted text-center">
                        Por favor, certifique-se que este é um endereço de email válido, e o
                        destinatário receberá um email de confirmação.
                    </p>
                </div>
                <div class="block-content block-content-full">
                    @if(setting()->invite_on)
                        @if(auth()->user()->invites > 0)
                            {!! Form::open(['url' => 'invites', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('email', 'E-mail', ['class' => 'col-md-12']) !!}
                                <div class="col-md-12">
                                    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'E-mail', 'maxlength' => 70, 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-1">
                                    {!! Form::submit('Convidar', ['class' => 'btn btn-primary btn-rounded btn-outline']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        @else
                            <p class="text-center">Seu limite de convites foi atingido. Verifique
                                novamente mais tarde...</p>
                        @endif
                    @else
                        <p class="text-center">Convites fechados no momento. Verifique novamente
                            mais tarde...</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
    <div class="card mb-3">
        <div class="card-body">
            <div class="card-title with-elements">
                <h5 class="m-0 mr-2">Meus Convites</h5>
            </div>
            <div class="block">
                <div class="block-header">
                    <p class="text-muted text-center">
                        Sua/Seu amiga(o) tem {{ setting()->invitedays }} dias para aceitar o
                        convite, até que o mesmo seja deletado.
                    </p>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>E-mail</th>
                            <th>Data do convite</th>
                            <th>Expira em</th>
                            <th>Re-enviar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invites as $invite)
                            <tr>
                                <td>{{ $invite->email }}</td>
                                <td>{{ $invite->getCreateDate() }}</td>
                                <td>{{ $invite->getExpireDate() }}</td>
                                <td>
                                    @if ($invite->accepted_at !== null)
                                    <a class="btn btn-xs btn-success" href="{{ route('invite.resend', ['id' => $invite->id]) }}">
                                        <i class="fa fa-sync-alt"></i> Re-enviar
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <p class="text-center">Nenhum convite enviado no momento!</p>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
