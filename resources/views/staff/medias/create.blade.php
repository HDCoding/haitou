@extends('layouts.dashboard')

@section('title', 'Adicionar')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <!-- DatePicker -->
    <link href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/medias') }}">@lang('dashboard.medias')</a></li>
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
                        <h4 class="card-title">Adicionar</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::open(['url' => 'staff/medias', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('media_type', 'Tipo: *') !!}
                            {!! Form::select('media_type', [
                                1 => 'Anime',
                                2 => 'Manga',
                                3 => 'Dorama',
                                4 => 'Filme'
                            ], null, ['class' => 'form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('name', 'Nome: *') !!}
                            {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('title_english', 'Título Inglês:') !!}
                            {!! Form::text('title_english', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('title_japanese', 'Título Japonês:') !!}
                            {!! Form::text('title_japanese', null, ['class' => 'form-control', 'maxlength' => 255]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('category_id', 'Categoria: *') !!}
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('studio_id', 'Studio: *') !!}
                            {!! Form::select('studio_id', $studios, null, ['class' => 'form-control select2', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('genre_id', 'Gêneros: *') !!}
                            {!! Form::select('genre_id[]', $genres, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('released_at', 'Data Lançamento: *') !!}
                            {!! Form::text('released_at', null, ['class' => 'form-control datas', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                {!! Form::label('finished_at', 'Data Finalização:') !!}
                                {!! Form::text('finished_at', null, ['class' => 'form-control datas']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição: *') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('adult', 'Adulto: *') !!}
                            {!! Form::select('adult', [0 => 'Não', 1 => 'Sim'], null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status', [
                                1 => 'Finalizado',
                                2 => 'Exibindo',
                                3 => 'Cancelado'
                            ], null, ['class' => 'custom-select form-control', 'required']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('yt_video', 'Youtube Trailer:') !!}
                            {!! Form::text('yt_video', null, ['class' => 'form-control', 'placeholder' => 'YT video', 'maxlength' => 45]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('total_episodes', 'Total episodios:') !!}
                            {!! Form::number('total_episodes', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('duration', 'Duração:') !!}
                            {!! Form::number('duration', null, ['class' => 'form-control', 'placeholder' => 'Minutos']) !!}
                        </div>

                        <p class="text-info">Somente se for manga</p>

                        <div class="form-group">
                            {!! Form::label('total_chapters', 'Capítulos:') !!}
                            {!! Form::number('total_chapters', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('total_volumes', 'Volumes:') !!}
                            {!! Form::number('total_volumes', null, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded']) !!}
                        <br />
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>
    <!-- DatePicker -->
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".select2").select2();

            $('.datas').datepicker({
                format: 'yyyy-mm-dd',
                language: 'pt-BR',
                autoclose: true
            });

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
