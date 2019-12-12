@extends('layouts.dashboard')

@section('title', trans('dashboard.torrents'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.torrents')</li>
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
                        <h4 class="card-title">@lang('dashboard.torrents')</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Tamanho</th>
                                    <th>Views</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($torrents as $torrent)
                                    <tr>
                                        <td class="text-center">{{ $torrent->id }}</td>
                                        <td class="">{{ $torrent->category->name }}</td>
                                        <td class="">{{ $torrent->name }}</td>
                                        <td class="">{{ $torrent->size() }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $torrent->views }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Opções
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ url('staff/torrents/' . $torrent->id . '/edit') }}"><i class="fas fa-pencil-alt text-info"></i> Editar</a>

                                                    <a class="dropdown-item" class="m-l-15" href="javascript:;" onclick="document.getElementById('file-freeleech-{{ $torrent->id }}').submit();"><i class="fa fa-download text-info"></i> Freeleech
                                                        @if($torrent->is_freeleech) <i class="fa fa-check text-success"></i> @endif </a>
                                                    {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/freeleech', 'method' => 'PUT', 'id' => 'file-freeleech-' . $torrent->id , 'style' => 'display: none']) !!}
                                                    {!! Form::close() !!}
                                                    <a class="dropdown-item" class="m-l-15" href="javascript:;" onclick="document.getElementById('file-silver-{{ $torrent->id }}').submit();"><i class="fas fa-star-half-alt text-cyan"></i> Silver
                                                        @if($torrent->is_silver) <i class="fa fa-check text-success"></i> @endif </a>
                                                    {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/silver', 'method' => 'PUT', 'id' => 'file-silver-' . $torrent->id , 'style' => 'display: none']) !!}
                                                    {!! Form::close() !!}
                                                    <a class="dropdown-item" class="m-l-15" href="javascript:;" onclick="document.getElementById('file-doubleup-{{ $torrent->id }}').submit();"><i class="fa fa-forward text-warning"></i>  Double UP
                                                        @if($torrent->is_doubleup) <i class="fa fa-check text-success"></i> @endif </a>
                                                    {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/doubleup', 'method' => 'PUT', 'id' => 'file-doubleup-' . $torrent->id , 'style' => 'display: none']) !!}
                                                    {!! Form::close() !!}
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" class="m-l-15" href="javascript:;" onclick="document.getElementById('file-del-{{ $torrent->id }}').submit();"><i class="fa fa-times text-danger"></i> Deletar</a>
                                                    {!! Form::open(['url' => 'staff/torrents/' . $torrent->id, 'method' => 'DELETE', 'id' => 'file-del-' . $torrent->id , 'style' => 'display: none']) !!}
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
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
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
