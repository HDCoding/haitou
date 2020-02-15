@extends('layouts.dashboard')

@section('title', 'Editar Fansub')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('fansubs') }}">Fansubs</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('fansub.show', [$fansub->id, $fansub->slug]) }}">{{ $fansub->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Fansub</li>
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
                        <h4 class="card-title">Editar Fansub</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::model($fansub, ['url' => 'fansub/'.$fansub->id.'/edit', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        @include('staff.fansubs.form', ['submitButton' => 'Editar'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
