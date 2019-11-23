@extends('layouts.dashboard')

@section('subtitle', 'Adicionar - Pesquisa')

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
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Pesquisa</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/polls', 'class' => 'form-horizontal push-5-t']) !!}
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
                {!! Form::label('option', 'Opção 1: *', ['class' => 'col-xs-12']) !!}
                {!! Form::text('option[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
            </div>

            <div class="form-group after-add-more">
                {!! Form::label('option', 'Opção 2: *', ['class' => 'col-xs-12']) !!}
                <div class="input-group">
                    {!! Form::text('option[]', null, ['class' => 'form-control', 'maxlength' => 250, 'required']) !!}
                    <span class="input-group-btn">
                        <button class="btn btn-success add-more" type="button">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </span>
                </div>
            </div>

            <br>
            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
            <br>
            {!! Form::close() !!}

            <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input -->
            <div class="form-group copy-fields" id="hide" style="display: none">
                <label for="option" class="col-xs-12">Opção: *</label>
                <div class="form-group control-group input-group">
                    <input type="text" name="option[]" class="form-control" maxlength="250" required>
                    <div class="input-group-btn">
                        <button class="btn btn-danger remove" type="button">
                            <i class="fa fa-minus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>

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
            //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
            $(".add-more").click(function(){
                var html = $('#hide').html();
                $(".after-add-more").after(html);
            });
            //here it will remove the current value of the remove button which has been pressed
            $("body").on("click", ".remove", function() {
                $(this).parents(".control-group").remove();
            });

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
