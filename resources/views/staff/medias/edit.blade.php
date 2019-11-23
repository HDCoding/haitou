@extends('layouts.dashboard')

@section('subtitle', 'Editar Mídia')

@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <!-- DatePicker -->
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.css') }}">
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
                <a href="{{ url('staff/medias') }}">@lang('dashboard.medias')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Mídia</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($media, ['url' => 'staff/medias/' . $media->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('media_type', 'Tipo: *') !!}
                {!! Form::select('media_type', [0 => 'Anime', 1 => 'Manga', 2 => 'Dorama'], null, ['class' => 'form-control', 'required']) !!}
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
                {!! Form::select('genre_id[]', $genres, $genre, ['class' => 'form-control select2', 'multiple' => 'multiple', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('released_at', 'Data Lançamento: *') !!}
                {!! Form::text('released_at', $media->released, ['class' => 'form-control datas', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('finished_at', 'Data Finalização:') !!}
                {!! Form::text('finished_at', $media->finished, ['class' => 'form-control datas']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição: *') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('adult', 'Adulto: *') !!}
                {!! Form::select('adult', [false => 'Não', true => 'Sim'], null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('cover', 'Cover:') !!}
                {!! Form::text('cover', null, ['class' => 'form-control', 'placeholder' => 'Link da imagem retangular/horizontal', 'maxlength' => 255]) !!}
            </div>

            <div class="form-group">
                {!! Form::label('poster', 'Poster:') !!}
                {!! Form::text('poster', null, ['class' => 'form-control', 'placeholder' => 'Link da imagem Poster', 'maxlength' => 255]) !!}
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

            {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline']) !!}
            <br />

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>
    <!-- DatePicker -->
    <script src="{{ asset('vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
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
