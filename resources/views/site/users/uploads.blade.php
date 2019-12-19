@extends('layouts.dashboard')

@section('title', 'Meus Uploads')

@section('css')
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">Meus Uploads</li>
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
                        <h4 class="card-title">Meus Uploads</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Tamanho</th>
                                    <th>Seeders</th>
                                    <th>Leechers</th>
                                    <th>Completado</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($uploads as $upload)
                                    <tr>
                                        <td>
                                            <a href="{{ route('torrent.show', ['id' => $upload->id, 'slug' => $upload->slug]) }}" target="_blank">
                                                {{ $upload->name }}
                                            </a>
                                            <div class="pull-right">
                                                <a href="{{ route('torrent.download', ['id' => $upload->id]) }}">
                                                    <button class="btn btn-xs btn-primary btn-round" type="button">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>
                                        <td>{{ $upload->category->name }}</td>
                                        <td><span class="badge badge-info font-weight-bold"> {{ $upload->size() }}</span></td>
                                        <td><span class="badge badge-success font-weight-bold"> {{ $upload->seeders }}</span></td>
                                        <td><span class="badge badge-danger font-weight-bold"> {{ $upload->leechers }}</span></td>
                                        <td><span class="badge badge-warning font-weight-bold"> {{ $upload->times_completed }}</span></td>
                                        <td>
                                            {{ (format_date($upload->created_at) ? $upload->created_at->diffForHumans() : 'N/A') }}
                                        </td>
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
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });

        });
    </script>
@endsection
