@extends('layouts.dashboard')

@section('subtitle', 'Editar - Atriz ou Ator')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/actors') }}">@lang('dashboard.actors')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Atriz ou Ator</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($actor, ['url' => 'staff/actors/' . $actor->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            @include('staff.actors.form', ['submitButton' => 'Editar'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection
