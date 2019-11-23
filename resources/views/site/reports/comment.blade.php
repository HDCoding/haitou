@extends('layouts.dashboard')

@section('subtitle', 'Reportar Comentário')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Reportar Comentário</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Reportar comentário de: {{ $comment->user->name }}</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'report', 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('report_type', 3) !!}
            {!! Form::hidden('comment_id', $comment->id) !!}
            @include('site.reports.form', ['submitButton' => 'Reportar'])
            {!! Form::close() !!}

        </div>
    </div>

@endsection
