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
                            <li class="breadcrumb-item"><a href="{{ url('torrents') }}">Torrents</a></li>
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Categoria</th>
                                    <th>Tamanho</th>
                                    <th>Seeders</th>
                                    <th>Leechers</th>
                                    <th>Downloads</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($uploads as $upload)
                                    <tr>
                                        <th>
                                            <a href="{{ route('torrent.show', ['id' => $torrent->id, 'slug' => $torrent->slug]) }}" target="_blank">
                                                {{ $torrent->name }}
                                            </a>
                                            <div class="pull-right">
                                                <a href="{{ route('torrents.edit', [$torrent->id]) }}">
                                                    <button class="btn btn-xs btn-success btn-round" type="button">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ route('torrent.download', ['id' => $torrent->id]) }}">
                                                    <button class="btn btn-xs btn-primary btn-round" type="button">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </th>
                                        <td>{{ $torrent->category->name }}</td>
                                        <td><span class="text-info font-weight-bold"> {{ $torrent->size() }}</span></td>
                                        <td><span class="text-success font-weight-bold"> {{ $torrent->seeders }}</span></td>
                                        <td><span class="text-danger font-weight-bold"> {{ $torrent->leechers }}</span></td>
                                        <td><span class="text-warning font-weight-bold"> {{ $torrent->times_completed }}</span></td>
                                        <td>{{ $torrent->created_at->diffForHumans() }}</td>
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
                "searching": false,
                "responsive": true,
                "order": [[ 0, "asc" ]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });

        });
    </script>
@endsection
