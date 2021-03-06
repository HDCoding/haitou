@extends('layouts.dashboard')

@section('title', 'Editar Tópico')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('forum') }}">Fórum</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Tópico</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Editar Tópico</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::model($topic, ['route' => ['topic.edit', 'topic_id' => $topic->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group ">
                            {!! Form::label('name', 'Título do tópico: *', ['class' => 'form-label']) !!}
                            {!! Form::text('name', $topic->name, ['class' => 'form-control', 'required', 'maxlength' => 250, 'minlength' => 3]) !!}
                        </div>
                        {!! Form::submit('Editar título', ['class' => 'btn btn-primary btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
