@extends('layouts.dashboard')

@section('subtitle', 'Editar Pesquisa')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/polls') }}">@lang('dashboard.polls')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar: {{ $poll->name }}</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
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
                @foreach($poll->poll_options as $option)
                    <li>{{ $option->option }}</li>
                @endforeach
            </ul>
            <hr>

            {!! Form::submit('Editar', ['class' => 'btn btn-success btn-rounded btn-outline-success']) !!}
            <br>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            //sceditor
            var textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
