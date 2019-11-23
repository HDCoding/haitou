@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Fansubs')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/fansubs') }}">@lang('dashboard.fansubs')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Fansub</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/fansubs', 'class' => 'form-horizontal']) !!}
            @include('staff.fansubs.form', ['submitButton' => 'Adicionar'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection
