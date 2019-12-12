@extends('layouts.dashboard')

@section('title', trans('dashboard.reports'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.reports')</li>
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
                        <h4 class="card-title">@lang('dashboard.reports')</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Assunto</th>
                                    <th>Tipo</th>
                                    <th>Resolvido</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <td class="text-center">{{ $report->id }}</td>
                                        <td>{{ link_to_route('reports.show', $report->name, ['id' => $report->id]) }}</td>
                                        <td>{!! $report->type() !!}</td>
                                        <td class="hidden-xs">{!! $report->solved() !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
                "displayLength": 50,
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
