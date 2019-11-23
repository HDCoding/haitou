@extends('layouts.dashboard')

@section('subtitle', 'Editar Faq')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/faqs') }}">@lang('dashboard.faqs')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Faq</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($faq, ['url' => 'staff/faqs/' . $faq->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            @include('staff.faqs.form', ['submitButton' => 'Editar'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection
