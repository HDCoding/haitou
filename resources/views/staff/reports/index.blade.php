@extends('layouts.dashboard')

@section('title', trans('dashboard.reports'))

@section('css')
    <!-- DataTables -->
    <link href="{{ secure_asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
            <div class="col-md-12">
                <canvas id="chart-report" height="70"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('dashboard.reports')</h4>
                        <div class="row m-t-40">
                            <!-- Column -->
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-info text-center">
                                        <h1 class="font-light text-white">{{ $total }}</h1>
                                        <h6 class="text-white">Total Reports</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-success text-center">
                                        <h1 class="font-light text-white">{{ $resolve }}</h1>
                                        <h6 class="text-white">Resolvido</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-6 col-lg-3 col-xlg-3">
                                <div class="card card-hover">
                                    <div class="box bg-dark text-center">
                                        <h1 class="font-light text-white">{{ $pending }}</h1>
                                        <h6 class="text-white">Pendente</h6>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Assunto</th>
                                    <th>ID</th>
                                    <th>Resolvido</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reports as $report)
                                    <tr>
                                        <th>{!! $report->type() !!}</th>
                                        <td><a href="{{ $report->linkTo($report->id) }}">{{ $report->name }}</a></td>
                                        <td>{{ $report->id }}</td>
                                        <td>{!! $report->solved() !!}</td>
                                        <td>{{ format_date_time($report->created_at) }}</td>
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
    <!-- Datatables -->
    <script src="{{ secure_asset('vendor/datatables/datatables.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": false,
                "responsive": true,
                "order": [[ 2, "desc" ]],
                "language": {
                    "url": '{{ secure_asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
        });
    </script>

    <!-- Bar Chart -->
    <script src="{{ secure_asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        new Chart(document.getElementById('chart-report'), {
            type: 'bar',
            data: {
                labels: ["Calendários", "Comentários", "Membro", "Post", "Torrent"],
                datasets: [{
                    label: "Reports",
                    backgroundColor: ["#263673", "#57355e", "#d2512e", "#df243f", "#6052e2"],
                    data: [{{ $calendars }}, {{ $comments }}, {{ $members }}, {{ $posts }}, {{ $torrents }}]
                }]
            },
            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: 'Chart dos Reports'
                }
            }
        });
    </script>
@endsection
