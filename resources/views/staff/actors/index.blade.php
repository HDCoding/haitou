@extends('layouts.dashboard')

@section('title', trans('dashboard.actors'))

@section('css')
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.actors')</li>
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
                        <h4 class="card-title">@lang('dashboard.actors')</h4>
                        <a href="{{ url('staff/actors/create') }}">
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
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($actors as $actor)
                                    <tr>
                                        <th>
                                            <img class="" src="{{ asset('actors/'.$actor->image) }}" alt="{{ $actor->name }}" width="70px">
                                        </th>
                                        <td>{{ $actor->name }}</td>
                                        <td><span class="badge badge-info">{{ $actor->views }}</span></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/actors/' . $actor->id . '/edit') }}" data-toggle="tooltip" title="Editar Atriz/Ator">
                                                    <i class="fas fa-pencil-alt"></i> Editar
                                                </a>
                                                <a href="javascript:;" class="m-l-10" onclick="document.getElementById('actor-del-{{ $actor->id }}').submit();" data-toggle="tooltip" title="Remover Atriz/Ator">
                                                    <i class="fas fa-times"></i> Deletar
                                                </a>
                                                {!! Form::open(['url' => 'staff/actors/' . $actor->id, 'method' => 'DELETE', 'id' => 'actor-del-' . $actor->id , 'style' => 'display: none']) !!}
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
