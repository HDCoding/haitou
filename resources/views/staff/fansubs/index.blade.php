@extends('layouts.dashboard')

@section('title', trans('dashboard.fansubs'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.fansubs')</li>
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
                        <h4 class="card-title">Conquistas</h4>
                        <a href="{{ secure_url('staff/fansubs/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-user"></i></th>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center"><i class="fas fa-file-alt text-warning"></i> Torrents</th>
                                    <th class="text-center"><i class="fas fa-eye"></i> Views</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fansubs as $fansub)
                                    <tr>
                                        <td class="text-center">
                                            <img class="" src="{{ $fansub->logo }}" alt="{{ $fansub->name }}" width="70px">
                                        </td>
                                        <td class="text-center">{{ $fansub->name }}</td>
                                        <td class="text-center">{{ $fansub->torrents->count() }}</td>
                                        <td class="text-center">
                                            <span class="badge badge-info">{{ $fansub->views }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ secure_url('staff/fansub/' . $fansub->id . '/members') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Fansub Membros"><i class="fas fa-users text-success"></i> Membros</a>
                                                <a href="{{ secure_url('staff/fansubs/' . $fansub->id . '/edit') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Editar Fansub"><i class="fas fa-pencil-alt text-info"></i> Editar</a>
                                                <a href="javascript:;" onclick="document.getElementById('fansub-del-{{ $fansub->id }}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Fansub"><i class="fas fa-times text-danger"></i> Deletar</a>
                                                {!! Form::open(['url' => 'staff/fansubs/' . $fansub->id, 'method' => 'DELETE', 'id' => 'fansub-del-' . $fansub->id , 'style' => 'display: none']) !!}
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
