@extends('layouts.dashboard')

@section('title', trans('dashboard.failedlogins'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.failedlogins')</li>
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
                        <h4 class="card-title">@lang('dashboard.failedlogins')</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>E-mail</th>
                                    <th>IP</th>
                                    <th>Browser</th>
                                    <th>System</th>
                                    <th>Mobile</th>
                                    <th>Tablet</th>
                                    <th>Desktop</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attempts as $attempt)
                                    <tr>
                                        <th scope="row">{{ $attempt->id }}</th>
                                        <td>{{ !empty($attempt->user_id) ? $attempt->user->username : ''}}</td>
                                        <td>{{ !empty($attempt->email) ? $attempt->email : '' }}</td>
                                        <td>{{ $attempt->ip }}</td>
                                        <td>{{ $attempt->user_agent }}</td>
                                        <td>{{ $attempt->os }}</td>
                                        <td>{{ $attempt->is_mobile ? 'Sim' : 'Nao'}}</td>
                                        <td>{{ $attempt->is_tablet ? 'Sim' : 'Nao'}}</td>
                                        <td>{{ $attempt->is_desktop ? 'Sim' : 'Nao' }}</td>
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
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
        });
    </script>
@endsection
