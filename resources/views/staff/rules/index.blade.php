@extends('layouts.dashboard')

@section('title', trans('dashboard.rules'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.rules')</li>
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
                        <h4 class="card-title">@lang('dashboard.rules')</h4>
                        <a href="{{ url('staff/rules/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Cor</th>
                                    <th>Ícone</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rules as $rule)
                                    <tr>
                                        <th>{{ $rule->id }}</th>
                                        <td>{{ $rule->name }}</td>
                                        <td style="color:{{ $rule->color }}"><b>{{ $rule->color }}</b></td>
                                        <td>{{ $rule->icon }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/rules/' . $rule->id . '/edit') }}" data-toggle="tooltip" title="Editar Regra"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a href="javascript:;" onclick="document.getElementById('rule-del-{{ $rule->id }}').submit();" class="m-l-15" data-toggle="tooltip" title="Remover Regra"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/rules/' . $rule->id, 'method' => 'DELETE', 'id' => 'rule-del-' . $rule->id , 'style' => 'display: none']) !!}
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
