@extends('layouts.dashboard')

@section('subtitle', 'Alterar passkey')

@section('content')

    <div class="font-weight-bold py-3 h4">
        Alterar passkey
    </div>

    @includeIf('errors.errors', [$errors])
    {!! Form::open(['url' => 'user/edit/passkey', 'class' => 'form-horizontal', 'autocomplete' => 'off', 'id' => 'passkey', 'name' => 'passkey']) !!}
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            @include('site.users.list-links')
            <div class="col-md-9">
                <div class="tab-content">

                    <div class="card-body">
                        <h5 class="mb-2 mt-5">
                            <i class="fas fa-key text-info"></i>
                            Meu Passkey:
                        </h5>
                        {{ auth()->user()->passkey }}
                    </div>
                    <div class="card-body">
                        <p class="mb-2 text-danger">Alterando seu passkey, voce precisa baixar todos os torrents que baixou anteriormente para continuar seedando</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-right mt-3">
        <button type="submit" class="btn btn-primary">Alterar</button>&nbsp;
        <button type="button" class="btn btn-default">Cancelar</button>
    </div>
    {!! Form::close() !!}

@endsection
