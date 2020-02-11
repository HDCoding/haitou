@extends('layouts.dashboard')

@section('title', 'Convites')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Convites</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Convites</h4>
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
                                @if(setting('invite_on'))
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
                                        <p class="text-center">Seu limite de convites foi atingido. Verifique novamente mais tarde...</p>
                                    @endif
                                @else
                                    <p class="text-center">Convites fechados no momento. Verifique novamente mais tarde...</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Meus Convites</h4>
                        <p class="text-muted text-center">
                            Sua/Seu amiga(o) tem <b class="text-danger font-16">{{ setting('invite_days') }}</b> dias para aceitar o
                            convite, até que o mesmo seja deletado.
                        </p>
                        <div class="table-responsive m-t-15">
                            <table class="table">
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
                                        <th>{{ $invite->email }}</th>
                                        <td>{{ format_date($invite->created_at) }}</td>
                                        <td>{{ format_date($invite->expires_on) }}</td>
                                        <td>
                                            @if (!empty($invite->accepted_at) AND $invite->created_at < now()->copy()->subDays(2)->toDateTimeString())
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
        </div>
    </div>

@endsection
