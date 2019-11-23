@extends('layouts.dashboard')

@section('subtitle', 'Suspender Usuário')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/users') }}">@lang('dashboard.users')</a>
            </li>
            <li class="breadcrumb-item active">Suspender</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Suspender - {{ $user->name }}</h6>
        <div class="card-body">

            <div class="block">
                <div class="block-content">
                    <div class="block-header">
                        <p class="text-center">Você tem certeza que deseja suspender: <b>{{ $user->name }}</b>?</p>
                        <p class="text-center">Depois da data de expiração o usuário poderá voltar a logar no site.</p>
                    </div>

                    @includeIf('errors.errors', [$errors])
                    {!! Form::open(['url' => 'staff/user/suspend', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('days', 'Dias: *') !!}
                        {!! Form::number('days', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    @include('staff.users.modform', ['submitButton' => 'Suspender'])
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
