@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.bonus'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.bonus')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/bonus/create') }}">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="js-table-sections table table-hover">
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
                                <a href="javascript:;" onclick="document.getElementById('bonus-upd-{{ $b->id }}').submit();" class="btn btn-xs btn-default" type="button">
                                    @if($b->is_enabled)
                                        <i class="fas fa-pause text-warning" data-toggle="tooltip" title="Desativar Bônus"></i>
                                    @else
                                        <i class="fas fa-play text-success" data-toggle="tooltip" title="Ativar Bônus"></i>
                                    @endif
                                </a>
                                {!! Form::open(['url' => 'staff/bonus/' . $b->id . '/update', 'method' => 'PUT', 'id' => 'bonus-upd-' . $b->id, 'style' => 'display: none']) !!}
                                {!! Form::close() !!}
                                <a href="{{ url('staff/bonus/' . $b->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Bônus"><i class="fas fa-pencil-alt text-info"></i></a>
                                <a href="javascript:;" onclick="document.getElementById('bonus-del-{{ $b->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Bônus"><i class="fa fa-times text-danger"></i></a>
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

@endsection
