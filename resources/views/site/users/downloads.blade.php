@extends('layouts.dashboard')

@section('title', 'Meus Downloads')

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
                            <li class="breadcrumb-item active" aria-current="page">Meus Downloads</li>
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
                        <h4 class="card-title">Meus Downloads</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
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
                                @foreach ($downloads as $download)
                                    <tr class="userFiltered" active="{{ $download->is_active ? '1' : '0' }}"
                                        seeding="{{ $download->is_seeder == 1 ? '1' : '0' }}"
                                        released="{{ $download->is_released ? '1' : '0' }}">
                                        <th>
                                            <a href="{{ route('torrent.show', ['id' => $download->torrent->id, 'slug' => $download->torrent->slug]) }}" target="_blank">
                                                {{ $download->torrent->name }}
                                            </a>
                                            <div class="pull-right">
                                                <a href="{{ route('torrent.download', ['id' => $download->torrent->id]) }}">
                                                    <button class="btn btn-xs btn-primary btn-round" type="button">
                                                        <i class="fas fa-download"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </th>
                                        <td>{{ $download->category->name }}</td>
                                        <td><span class="text-info font-weight-bold"> {{ $download->torrent->size() }}</span></td>
                                        <td><span class="text-success font-weight-bold"> {{ $download->torrent->seeders }}</span></td>
                                        <td><span class="text-danger font-weight-bold"> {{ $download->torrent->leechers }}</span></td>
                                        <td><span class="text-warning font-weight-bold"> {{ $torrent->torrent->times_completed }}</span></td>
                                        <td>{{ $download->completed_at && $download->completed_at != null ? $download->completed_at->diffForHumans() : 'N/A' }}</td>
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
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });

        });
    </script>
@endsection
