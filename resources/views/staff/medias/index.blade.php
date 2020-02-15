@extends('layouts.dashboard')

@section('title', trans('dashboard.medias'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.medias')</li>
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
                        <h4 class="card-title">@lang('dashboard.medias')</h4>
                        <a href="{{ url('staff/medias/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-image"></i></th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Genero</th>
                                    <th>Views</th>
                                    <th>Estudio</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($medias as $media)
                                    <tr>
                                        <td class="align-middle"><img class="img-fluid" src="{{ $media->poster() }}" alt="{{ $media->name }}" width="70px"></td>
                                        <td class="align-middle">{{ $media->category->name }}</td>
                                        <td class="align-middle">{{ $media->name }}</td>
                                        <td class="align-middle">{!! $media->type() !!}</td>
                                        <td class="align-middle"><span class="badge badge-info">{{ $media->views }}</span></td>
                                        <td class="align-middle">{{ $media->studio->name }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/media/' . $media->id . '/images') }}" data-toggle="tooltip" title="Imagens"><i class="fas fa-image text-success"></i></a>
                                                <a class="m-l-15" href="{{ url('staff/media/' . $media->id . '/casts') }}" data-toggle="tooltip" title="Casts"><i class="fas fa-users text-warning"></i></a>
                                                <a class="m-l-15" href="{{ url('staff/medias/' . $media->id . '/edit') }}" data-toggle="tooltip" title="Editar Mídia"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('media-del-{{ $media->id }}').submit();" data-toggle="tooltip" title="Remover Mídia"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/medias/' . $media->id, 'method' => 'DELETE', 'id' => 'media-del-' . $media->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
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
                "order": [[ 2, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
