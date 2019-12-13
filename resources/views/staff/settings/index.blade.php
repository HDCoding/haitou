@extends('layouts.dashboard')

@section('title', trans('dashboard.settings'))

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.settings')</li>
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
                        <h4 class="card-title">@lang('dashboard.settings')</h4>
                        <h6 class="card-subtitle">Use default tab with class <code>nav-tabs & tabcontent-border </code></h6>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#setting" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Configurações</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#favicon" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Favicon</span></a> </li>
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#images" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Imagens</span></a> </li>
                        </ul>
                        @includeIf('errors.errors', [$errors])
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="setting" role="tabpanel">
                                <div class="form-group">
                                    {!! Form::label('site_title', 'Site Título: *') !!}
                                    {!! Form::text('site_title', $settings, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('meta_keywords', 'Meta Keywords') !!}
                                    {!! Form::textarea('meta_keywords', $settings, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('meta_description', 'Meta Descrição') !!}
                                    {!! Form::textarea('meta_description', $settings, ['class' => 'form-control', 'rows' => 3]) !!}
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="favicon" role="tabpanel">
                                2
                            </div>
                            <div class="tab-pane p-20" id="images" role="tabpanel">
                                3
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 25,
                "searching": true,
                "responsive": true,
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
