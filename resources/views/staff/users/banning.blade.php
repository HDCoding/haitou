@extends('layouts.dashboard')

@section('title', 'Banir')

@section('css')
    <!-- sceditor -->
    <link href="{{ secure_asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">Banir</li>
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
                        <h4 class="card-title">Banir - {{ $user->username }}</h4>
                        <div class="block">
                            <div class="block-content">
                                <div class="block-header">
                                    <p class="text-center">Você tem certeza que deseja banir: <b>{{ $user->username }}</b>?</p>
                                    <p class="text-center">Essa opção não poder ser desfeita.</p>
                                </div>

                                @includeIf('errors.errors', [$errors])
                                @include('includes.messages')
                                {!! Form::open(['url' => 'staff/user/banning', 'class' => 'form-horizontal']) !!}
                                {!! Form::hidden('user_id', $user->id) !!}
                                <div class="form-group">
                                    {!! Form::label('title', 'Título: *') !!}
                                    {!! Form::text('title', null, ['class' => 'form-control', 'required', 'maxlength' => 100]) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('description', 'Descrição: *') !!}
                                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
                                </div>

                                <br>
                                {!! Form::submit('Banir', ['class' => 'btn btn-success btn-rounded mt-4']) !!}
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
    <script src="{{ secure_asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ secure_asset('vendor/sceditor/languages/pt-BR.js') }}"></script>
    <!-- sceditor -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
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
