@extends('layouts.dashboard')

@section('title', trans('dashboard.groups'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.groups')</li>
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
                        <h4 class="card-title">@lang('dashboard.groups')</h4>
                        <a href="{{ url('staff/groups/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Nome</th>
                                    <th>Cor</th>
                                    <th>Contas</th>
                                    <th>H-N-R</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td><i class="display-7 {{ $group->icon }}"></i></td>
                                        <td>{{ $group->name }}</td>
                                        <td style="color: {{ $group->color }}"><b>{{ $group->color }}</b></td>
                                        <td>{{ $group->users()->count() }}</td>
                                        <td>{{ ($group->hnr / 3600) }} Horas</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/groups/' . $group->id . '/edit') }}" data-toggle="tooltip" title="Editar Grupo"><i class="fas fa-pencil-alt text-info"></i></a>
                                                @if(auth()->user()->can('acesso-total'))
                                                    <a class="m-l-15" href="javascript:;" onclick="document.getElementById('role-del-{{$group->id}}').submit();" data-toggle="tooltip" title="Remover Grupo"><i class="fa fa-times text-danger"></i></a>
                                                    {!! Form::open(['url' => 'staff/groups/' . $group->id, 'method' => 'DELETE', 'id' => 'role-del-' . $group->id , 'style' => 'display: none']) !!}
                                                    {!! Form::close() !!}
                                                @endif
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
