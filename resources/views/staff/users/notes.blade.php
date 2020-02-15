@extends('layouts.dashboard')

@section('title', 'Anotações')

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
                            <li class="breadcrumb-item"><a href="{{ url('staff/users') }}">@lang('dashboard.users')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Anotações</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <h4 class="card-title">Anotações</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::open(['url' => 'staff/user/notes', 'class' => 'form-horizontal']) !!}
                        {!! Form::hidden('user_id', $user->id) !!}
                        <div class="form-group">
                            {!! Form::label('description', 'Anotação: *') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>
                        {!! Form::submit('Salvar', ['class' => 'btn btn-success btn-rounded btn-outline']) !!}
                        <br>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @foreach($notes as $note)
                    <div class="card m-b-20">
                        <div class="card-body">
                            <div class="card-title">
                                {{ format_date($note->created_at) }} || Por {{ $note->staff->username }}
                            </div>
                            {!! $note->descriptionHtml() !!}
                        </div>
                    </div>
                @endforeach
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
