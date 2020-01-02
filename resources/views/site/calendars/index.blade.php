@extends('layouts.dashboard')

@section('title', 'Calendário')

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
    <!-- Calendar CSS -->
    <!-- Custom CSS -->
    <link href="{{ asset('vendor/fullcalendar/dist/fullcalendar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet" />
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css') }}" rel="stylesheet"/>

    <style>
        #aviso {
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
        #loading {
            text-align: center;
            color: #bb0000;
            text-transform: uppercase;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Calendário</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-2 border-right p-r-0">
                                <div class="card-body border-bottom">
                                    <h4 class="card-title m-t-10">Legenda</h4>
                                </div>
                                <div class="card-body">
                                    @includeIf('errors.errors', [$errors])
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="calendar-events" class="">
                                                <div class="calendar-events m-b-20" data-class="bg-info"><i class="fa fa-circle text-info m-r-10"></i>Event One</div>
                                                <div class="calendar-events m-b-20" data-class="bg-success"><i class="fa fa-circle text-success m-r-10"></i> Event Two</div>
                                                <div class="calendar-events m-b-20" data-class="bg-danger"><i class="fa fa-circle text-danger m-r-10"></i>Event Three</div>
                                                <div class="calendar-events m-b-20" data-class="bg-warning"><i class="fa fa-circle text-warning m-r-10"></i>Event Four</div>
                                            </div>
                                             @if(auth()->user()->can('criar-calendario'))
                                            <a href="javascript:void(0)" data-toggle="modal" data-target="#fullcalendar-default-view-modal" class="btn m-t-20 btn-info btn-block waves-effect waves-light">
                                                <i class="ti-plus"></i> Adicionar
                                            </a>
                                             @else
                                                <p class="text-center font-weight-bold m-t-20 text-danger">Sua permissão de criar novos eventos foram revogadas!!</p>
                                             @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="card-body b-l calender-sidebar">
                                    <div id="aviso">Não foi possível conectar-se com banco de dados.</div>
                                    <div id="loading">Loading...</div>
                                    <div id="fullcalendar-default"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if(auth()->user()->can('criar-calendario'))
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
                        {!! Form::text('name', null, ['class' => 'form-control form-rounded', 'required', 'maxlength' => 250]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('color', 'Tipo:', ['class' => 'col-md-12']) !!}
                        {!! Form::select('color', [
                            '#007bff' => 'Primary',
                            '#dc3545' => 'Danger',
                            '#ffc107' => 'Warning',
                            '#28a745' => 'Success',
                            '#17a2b8' => 'Info'
                        ], null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('start_date', 'Início:', ['class' => 'col-md-12']) !!}
                        {!! Form::text('start_date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'Término:', ['class' => 'col-md-12']) !!}
                        {!! Form::text('end_date', null, ['class' => 'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('description', 'Descrição:', ['class' => 'col-md-12']) !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control form-rounded', 'rows' => 6, 'placeholder' => 'Descrição do evento']) !!}
                        <div id="charNum"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default md-btn-flat btn-rounded" data-dismiss="modal">Fechar</button>
                    {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-rounded btn-outline']) !!}
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        <!-- / Event modal -->
        @endif
    </div>

@endsection

@section('scripts')
    <!-- FullCalendar -->
    <script src="{{ asset('vendor/moment/moment.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('vendor/fullcalendar/dist/locale/pt-br.js') }}"></script>
    <script src="{{ asset('js/pages/fullcalendar.js') }}"></script>

    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.pt-BR.js') }}" charset="UTF-8"></script>

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
