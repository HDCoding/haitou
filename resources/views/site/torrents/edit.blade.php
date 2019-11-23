@extends('layouts.dashboard')

@section('subtitle', 'Torrent Editar')

@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('torrents') }}">Torrents</a>
            </li>
            <li class="breadcrumb-item active">Editar: {{ $torrent->name }}</li>
        </ol>
    </div>

    <div class="card mb-4">
        <h6 class="card-header">Editar</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['route' => ['update.torrent', 'id' => $torrent->id], 'method' => 'PUT',  'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nome:') !!}
                {!! Form::text('name', $torrent->name, ['class' => 'form-control', 'maxlength' => '250', 'required']) !!}
            </div>

            <div class="form-row">
                <div class="form-group col-sm-3">
                    {!! Form::label('category_id', 'Categoria:') !!}
                    {!! Form::select('category_id', $categories, $torrent->category_id, ['class' => 'custom-select select2']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('media_id', 'Mídia:') !!}
                    {!! Form::select('media_id', $medias, $torrent->media_id, ['class' => 'custom-select select2']) !!}
                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('fansub_id', 'Fansub:') !!}
                    {!! Form::select('fansub_id', $fansubs, $torrent->fansub_id, ['class' => 'custom-select select2']) !!}
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-sm-3">
                    {!! Form::label('allowcomments', 'Habilita comentário:') !!}
                    {!! Form::select('allowcomments', [false => 'Não', true => 'Sim'], $torrent->allowcomments, ['class' => 'custom-select', 'required']) !!}

                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('freeleech', 'Free Leech:') !!}
                    {!! Form::select('freeleech', [false => 'Não', true => 'Sim'], $torrent->freeleech, ['class' => 'custom-select', 'required']) !!}

                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('silver', 'Silver:') !!}
                    {!! Form::select('silver', [false => 'Não', true => 'Sim'], $torrent->silver, ['class' => 'custom-select', 'required']) !!}

                </div>
                <div class="form-group col-sm-3">
                    {!! Form::label('doubleup', 'Double UP:') !!}
                    {!! Form::select('doubleup', [false => 'Não', true => 'Sim'], $torrent->doubleup, ['class' => 'custom-select', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição:') !!}
                {!! Form::textarea('description', $torrent->description) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Alterar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
            </div>
            <br>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('.select2').select2();

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
