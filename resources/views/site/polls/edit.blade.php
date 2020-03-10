@extends('layouts.dashboard')

@section('title', 'Editar')

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('polls') }}">Pesquisas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <h4 class="card-title">Editar {{ $poll->name }}</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::model($poll, ['url' => 'staff/polls/' . $poll->id, 'method' => 'PUT', 'class' => 'form-horizontal push-5-t']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Pergunta: *', ['class' => 'col-xs-12']) !!}
                            {!! Form::text('name', $poll->name, ['class' => 'form-control', 'maxlength' => 255, 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('multi_choice', 'Múltipla escolha: *', ['class' => 'col-xs-12']) !!}
                            {!! Form::select('multi_choice', [false => 'Radio (apenas um)', true => 'Checkbox (multipla escolha)'], $poll->multi_choice, ['class' => 'form-control']) !!}
                            <span class="help-text">Você pode permitir que um usuário vote em mais de uma resposta selecionando a opção de caixa de seleção.</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>

                        <hr>
                        Opções:
                        <ul class="options">
                            @foreach($poll->options as $option)
                                <li>{{ $option->name }}</li>
                            @endforeach
                        </ul>
                        <hr>
                        {!! Form::submit('Editar', ['class' => 'btn btn-success btn-rounded']) !!}
                        {!! Form::close() !!}
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

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            //sceditor
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
