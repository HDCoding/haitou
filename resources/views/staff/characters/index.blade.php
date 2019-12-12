@extends('layouts.dashboard')

@section('title', trans('dashboard.characters'))

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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.characters')</li>
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
                        <h4 class="card-title">@lang('dashboard.characters')</h4>
                        <a href="{{ url('staff/characters/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Nome</th>
                                    <th>Views</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($characters as $character)
                                    <tr>
                                        <th>
                                            <img class="" src="{{ asset('characters/'.$character->image) }}" alt="{{ $character->name }}" width="70px">
                                        </th>
                                        <td>{{ $character->name }}</td>
                                        <td><span class="badge badge-info">{{ $character->views }}</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('staff/characters/' . $character->id . '/edit') }}" data-toggle="tooltip" title="Editar Personagem"><i class="fas fa-pencil-alt text-info"></i> Editar</a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('character-del-{{ $character->id }}').submit();" data-toggle="tooltip" title="Remover Personagem"><i class="fa fa-times text-danger"></i> Deletar</a>
                                                {!! Form::open(['url' => 'staff/characters/' . $character->id, 'method' => 'DELETE', 'id' => 'character-del-' . $character->id , 'style' => 'display: none']) !!}
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
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
