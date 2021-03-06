@extends('layouts.dashboard')

@section('title', 'Adicionar Poll')

@section('css')
    <!-- sceditor -->
    <link href="{{ secure_asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{ url('polls') }}">Polls</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar</li>
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
                        <h4 class="card-title">Nova Pesquisa</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')

                        {!! Form::open(['route' => ['site.save.poll'], 'class' => 'form-horizontal push-5-t']) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Pergunta: *') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('multi_choice', 'Múltipla escolha: *') !!}
                            {!! Form::select('multi_choice', [false => 'Radio (apenas um)', true => 'Checkbox (multipla escolha)'], null, ['class' => 'form-control']) !!}
                            <span class="help-text">Você pode permitir que um usuário vote em mais de uma resposta selecionando a opção de caixa de seleção.</span>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('options', 'Opção 1: *', ['class' => 'col-xs-12']) !!}
                            {!! Form::text('options[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                        </div>

                        <div class="form-group after-add-more">
                            {!! Form::label('options', 'Opção 2: *', ['class' => 'col-xs-12']) !!}
                            <div class="input-group">
                                {!! Form::text('options[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                                <span class="input-group-btn">
                                    <button class="btn btn-success add-more" type="button">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded']) !!}
                        {!! Form::close() !!}

                        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input -->
                        <div class="form-group copy-fields" id="hide" style="display: none">
                            <label for="options" class="col-xs-12">Opção: *</label>
                            <div class="form-group control-group input-group">
                                <input type="text" name="options[]" class="form-control" maxlength="250" required>
                                <div class="input-group-btn">
                                    <button class="btn btn-danger remove" type="button">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                </div>
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

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
            $(".add-more").click(function(){
                var html = $('#hide').html();
                $(".after-add-more").after(html);
            });
            //here it will remove the current value of the remove button which has been pressed
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });

            //SCEditor
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
