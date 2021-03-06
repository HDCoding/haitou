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
                                                {!! Form::submit('Convidar', ['class' => 'btn btn-primary btn-rounded mt-4']) !!}
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
        </div>

        <div class="row">
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
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($invites as $invite)
                                    <tr>
                                        <th>{{ $invite->email }}</th>
                                        <td>{{ format_date($invite->created_at) }}</td>
                                        <td>{{ format_date($invite->expires_on) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Convites Aceitos</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Membro</th>
                                    <th>Aceito em</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($acceptances as $accept)
                                    <tr>
                                        <th>{{ link_to_route('user.profile', $accept->member->username, ['slug' => $accept->member->slug]) }}</th>
                                        <td>{{ format_date($accept->accepted_at) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">
                                            <p class="text-center">Nenhum convite aceito no momento!</p>
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
