@extends('layouts.dashboard')

@section('title', 'Editar Calendário')

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet"/>
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
                            <li class="breadcrumb-item"><a href="{{ url('calendars') }}">Calendário</a></li>
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
                        <h4 class="card-title">Editar o evento</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::model($calendar, ['url' => 'calendars/' . $calendar->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Título:', ['class' => 'col-md-12']) !!}
                            {!! Form::text('name', $calendar->name, ['class' => 'form-control form-rounded', 'required', 'maxlength' => 250]) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('color', 'Tipo:', ['class' => 'col-md-12']) !!}
                            {!! Form::select('color', [
                                '#007bff' => 'Primary',
                                '#dc3545' => 'Danger',
                                '#ffc107' => 'Warning',
                                '#28a745' => 'Success',
                                '#17a2b8' => 'Info'
                            ], $calendar->color, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('start_date', 'Início:', ['class' => 'col-md-12']) !!}
                            {!! Form::text('start_date', $calendar->start_date, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('end_date', 'Término:', ['class' => 'col-md-12']) !!}
                            {!! Form::text('end_date', $calendar->end_date, ['class' => 'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:', ['class' => 'col-md-12']) !!}
                            {!! Form::textarea('description', $calendar->description, ['class' => 'form-control form-rounded', 'rows' => 6]) !!}
                        </div>
                        {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}"></script>

    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            let textarea = document.getElementById('description');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });

            //datetimer
            $('#start_date').datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                language: 'pt-BR'
            });
            $('#end_date').datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
                autoclose: true,
                language: 'pt-BR',
                useCurrent: false //Important! See issue #1075
            });
            $("#start_date").on("dp.change", function (e) {
                $('#end_date').data("DateTimePicker").minDate(e.date);
            });
            $("#end_date").on("dp.change", function (e) {
                $('#start_date').data("DateTimePicker").maxDate(e.date);
            });
        });
    </script>
@endsection
