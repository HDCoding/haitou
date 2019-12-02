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
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <hr>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 30px;"></th>
                                    <th>Tipo</th>
                                    <th style="width: 15%;">Tipo</th>
                                    <th style="width: 15%;">Pontos</th>
                                    <th style="width: 15%;">Ativado</th>
                                    <th class="hidden-xs" style="width: 15%;">Opções</th>
                                </tr>
                                </thead>
                                @forelse($bonus as $b)
                                    <tbody class="js-table-sections-header">
                                    <tr>
                                        <td class="text-center">
                                            <i class="fa fa-angle-right"></i>
                                        </td>
                                        <td class="">{{ $b->name }}</td>
                                        <td>
                                            <span class="badge badge-outline-primary">{{ $b->type() }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-outline-info">{{ $b->cost }}</span>
                                        </td>
                                        <td>{!! $b->enabled() !!}</td>
                                        <td class="hidden-xs text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('bonus-upd-{{ $b->id }}').submit();" class="btn btn-xs" type="button">
                                                    @if($b->is_enabled)
                                                        <i class="fas fa-pause text-warning" data-toggle="tooltip" title="Desativar Bônus"></i>
                                                    @else
                                                        <i class="fas fa-play text-success" data-toggle="tooltip" title="Ativar Bônus"></i>
                                                    @endif
                                                </a>
                                                {!! Form::open(['url' => 'staff/bonus/' . $b->id . '/update', 'method' => 'PUT', 'id' => 'bonus-upd-' . $b->id, 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{ url('staff/bonus/' . $b->id . '/edit') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Editar Bônus"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a href="javascript:;" onclick="document.getElementById('bonus-del-{{ $b->id }}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Bônus"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/bonus/' . $b->id, 'method' => 'DELETE', 'id' => 'bonus-del-' . $b->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">#</td>
                                        <td class="text-success" colspan="5">{{ $b->description }}</td>
                                    </tr>
                                    </tbody>
                                @empty
                                    <tbody>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center" colspan="5">Nada cadastrado no momento.</td>
                                    </tr>
                                    </tbody>
                                    @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
