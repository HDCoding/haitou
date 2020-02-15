@extends('layouts.dashboard')

@section('title', 'Passkey')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Passkey</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @include('site.users.update.card')
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    @include('site.users.update.links')
                    <div class="tab-content">
                        <div class="card-body">
                            <h4 class="card-title">Passkey</h4>
                            @includeIf('errors.errors', [$errors])
                            @include('includes.messages')
                            {!! Form::open(['url' => 'user/edit/passkey', 'class' => 'form-horizontal', 'autocomplete' => 'off']) !!}
                            <h5 class="mt-4">
                                <i class="fas fa-key text-info"></i>
                                Meu Passkey:
                            </h5>
                            {{ auth()->user()->passkey }}
                            <p class="mb-4 text-danger">Alterando seu passkey, voce precisa baixar todos os torrents que baixou anteriormente para continuar seedando</p>
                            <button type="submit" class="btn btn-primary btn-rounded">Alterar</button>&nbsp;
                            <button type="button" class="btn btn-default btn-rounded">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
