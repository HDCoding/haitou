@extends('layouts.dashboard')

@section('subtitle', 'Visitante - Navegadores')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/visitors') }}">@lang('dashboard.visitors')</a>
            </li>
            <li class="breadcrumb-item active">Navegadores</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Navegadores</h6>
        <div class="card-body">

        </div>
    </div>

@endsection
