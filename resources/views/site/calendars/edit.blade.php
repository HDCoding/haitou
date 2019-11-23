@extends('layouts.dashboard')

@section('subtitle', 'Calendário - Editar Post')

@section('css')
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet"/>
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('calendars') }}">Calendário</a>
            </li>
            <li class="breadcrumb-item active">Editar o evento</li>
        </ol>
    </div>

    <div class="card mb-4">
        <h6 class="card-header">
            Calendário - Editar o evento
        </h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($calendar, ['url' => 'calendars/' . $calendar->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Título:', ['class' => 'col-md-12']) !!}
                <div class="col-md-12">
                    {!! Form::text('name', $calendar->name, ['class' => 'form-control form-rounded', 'required', 'maxlength' => 250]) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('color', 'Tipo:', ['class' => 'col-md-12']) !!}
                <div class="col-md-12">
                    {!! Form::select('color', [
                        '#007bff' => 'Primary',
                        '#dc3545' => 'Danger',
                        '#ffc107' => 'Warning',
                        '#28a745' => 'Success',
                        '#17a2b8' => 'Info'
                    ], $calendar->color, ['class' => 'form-control', 'required']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('start_date', 'Início:', ['class' => 'col-md-12']) !!}
                <div class="col-md-12">
                    <div class="js-datetimepicker input-group date">
                        {!! Form::text('start_date', $calendar->start_date, ['class' => 'form-control', 'required']) !!}
                        <span class="input-group-addon">
                            <span class="fas fa-calendar-alt"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('end_date', 'Término:', ['class' => 'col-md-12']) !!}
                <div class="col-md-12">
                    <div class="js-datetimepicker input-group date">
                        {!! Form::text('end_date', $calendar->end_date, ['class' => 'form-control', 'required']) !!}
                        <span class="input-group-addon">
                            <span class="fas fa-calendar-alt"></span>
                        </span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição:', ['class' => 'col-md-12']) !!}
                <div class="col-md-12">
                    {!! Form::textarea('description', $calendar->description, ['class' => 'form-control form-rounded', 'rows' => 6]) !!}
                    <div id="charNum"></div>
                </div>
            </div>

            {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function () {
            $('#start_date').datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
            });
            $('#end_date').datetimepicker({
                format: 'yyyy-mm-dd hh:ii:ss',
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
