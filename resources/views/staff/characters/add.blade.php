@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Personagem')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/characters') }}">@lang('dashboard.characters')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Personagem</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/characters', 'class' => 'form-horizontal']) !!}
            @include('staff.characters.form', ['submitButton' => 'Adicionar'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection
