@extends('layouts.dashboard')

@section('subtitle', 'Calendario')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
    <!-- Calendar CSS -->
    <link href="{{ asset('vendor/fullcalendar/fullcalendar.css') }}" rel="stylesheet"/>
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet"/>

    <style>
        #aviso-view {
            display: none;
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            color: red;
        }

        #aviso-list {
            display: none;
            background: #eee;
            border-bottom: 1px solid #ddd;
            padding: 0 10px;
            line-height: 40px;
            text-align: center;
            font-weight: bold;
            font-size: 12px;
            color: red;
        }

        #loading-view {
            text-align: center;
            color: #bb0000;
            text-transform: uppercase;
            font-weight: bold;
        }

        #loading-list {
            text-align: center;
            color: #bb0000;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">Calendário</div>

    Legenda: < ul> colorida < /ul>

    @if(auth()->user()->permission->calendars_create)
    <a href="#" class="btn btn-success btn-outline-success" data-toggle="modal"
       data-target="#fullcalendar-default-view-modal"> Adicionar</a>
    @else
        <p class="text-center font-weight-bold">Sua permissão de criar novos eventos foram revogadas!!</p>
    @endif

    <hr class="border-light container-m--x mt-0 mb-4">
    @includeIf('errors.errors', [$errors])

    @if(auth()->user()->permission->calendars_create)
    <!-- Event modal -->
    {!! Form::open(['url' => 'calendars', 'class' => 'modal modal-top fade', 'autocomplete' => 'off', 'id' => 'fullcalendar-default-view-modal']) !!}
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar novo evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('name', 'Evento:', ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::text('name', null, ['class' => 'form-control form-rounded', 'required', 'maxlength' => 250]) !!}
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
                        ], null, ['class' => 'form-control', 'required']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('start_date', 'Início:', ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        <div class="js-datetimepicker input-group date">
                            {!! Form::text('start_date', null, ['class' => 'form-control', 'required']) !!}
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
                            {!! Form::text('end_date', null, ['class' => 'form-control', 'required']) !!}
                            <span class="input-group-addon">
                                <span class="fas fa-calendar-alt"></span>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Descrição:', ['class' => 'col-md-12']) !!}
                    <div class="col-md-12">
                        {!! Form::textarea('description', null, ['class' => 'form-control form-rounded', 'rows' => 6, 'placeholder' => 'Descrição do evento']) !!}
                        <div id="charNum"></div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default md-btn-flat" data-dismiss="modal">Close</button>
                {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-rounded btn-outline']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <!-- / Event modal -->
    @endif

    <div class="card mb-4">
        <div class="card-body">
            <div id="aviso-view">Não foi possível conectar-se com banco de dados.</div>
            <div id="loading-view">Loading...</div>
            <div id="fullcalendar-default-view"></div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div id="aviso-list">Não foi possível conectar-se com banco de dados.</div>
            <div id="loading-list">Loading...</div>
            <div id="fullcalendar-list-view"></div>
        </div>
    </div>

@endsection

@section('script')
    <!-- FullCalendar -->
    <script src="{{ asset('vendor/moment/moment.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/locale/pt-br.js') }}"></script>
    <script src="{{ asset('js/pages/pages_fullcalendar.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
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

    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
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
