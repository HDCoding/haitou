@extends('layouts.dashboard')

@section('title', trans('dashboard.bonus'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.bonus')</li>
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
                        <h4 class="card-title">@lang('dashboard.bonus')</h4>
                        <a href="{{ url('staff/bonus/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Tipo</th>
                                    <th>Tipo</th>
                                    <th>Pontos</th>
                                    <th>Ativado</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody class="js-table-sections-header">
                                @forelse($bonus as $b)
                                    <tr>
                                        <td><i class="fa fa-angle-right"></i></td>
                                        <td>{{ $b->name }}</td>
                                        <td><span class="badge badge-primary">{{ $b->type() }}</span></td>
                                        <td><span class="badge badge-info">{{ $b->cost }}</span></td>
                                        <td>{!! $b->enabled() !!}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('bonus-upd-{{ $b->id }}').submit();">
                                                    @if($b->is_enabled)
                                                        <i class="fas fa-pause text-warning" data-toggle="tooltip" title="Desativar Bônus"></i>
                                                    @else
                                                        <i class="fas fa-play text-success" data-toggle="tooltip" title="Ativar Bônus"></i>
                                                    @endif
                                                </a>
                                                {!! Form::open(['url' => 'staff/bonus/' . $b->id . '/update', 'method' => 'PUT', 'id' => 'bonus-upd-' . $b->id, 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                                <a class="m-l-15" href="{{ url('staff/bonus/' . $b->id . '/edit') }}" data-toggle="tooltip" title="Editar Bônus"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('bonus-del-{{ $b->id }}').submit();" data-toggle="tooltip" title="Remover Bônus"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/bonus/' . $b->id, 'method' => 'DELETE', 'id' => 'bonus-del-' . $b->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Nada cadastrado no momento.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
