@extends('layouts.dashboard')

@section('title', 'Suspender')

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/users') }}">@lang('dashboard.users')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Suspender</li>
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
                        <h4 class="card-title">Suspender - {{ $user->username }}</h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="block-header">
                                    <p class="text-center">Você tem certeza que deseja Suspender: <b>{{ $user->username }}</b>?</p>
                                    <p class="text-center">Depois da data de expiração o usuário poderá voltar a logar no site.</p>
                                </div>

                                @includeIf('errors.errors', [$errors])
                                @include('includes.messages')
                                {!! Form::open(['url' => 'staff/user/suspend', 'class' => 'form-horizontal']) !!}
                                {!! Form::hidden('user_id', $user->id) !!}
                                <div class="form-group">
                                    {!! Form::label('title', 'Título: *') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 100]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('days', 'Dias: *') !!}
                                    {!! Form::number('days', null, ['class' => 'form-control', 'required']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('description', 'Descrição: *') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
                                </div>
                                <br>
                                {!! Form::submit('Suspender', ['class' => 'btn btn-success btn-rounded btn-outline']) !!}
                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>
    <!-- sceditor -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //terms
            let textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
