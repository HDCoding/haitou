@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.roles'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.roles')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/roles/create') }}">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fas fa-user"></i></th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Cor</th>
                        <th>Contas</th>
                        <th>H-N-R</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td class="text-center">{{ $group->icon }}</td>
                        <td>{{ $group->name }}</td>
                        <td>{{ $group->description }}</td>
                        <td class="text-center">{{ $group->color }}</td>
                        <td class="text-center">{{ $group->users()->count() }}</td>
                        <td class="text-center">{{ $group->hnr / 3600 }} Horas</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('staff/roles/' . $group->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Grupo"><i class="fas fa-pencil-alt text-info"></i></a>
                                @if(auth()->user()->permission->full_access)
                                <a href="javascript:;" onclick="document.getElementById('role-del-{{$group->id}}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Grupo"><i class="fa fa-times text-danger"></i></a>
                                {!! Form::open(['url' => 'staff/roles/' . $group->id, 'method' => 'DELETE', 'id' => 'role-del-' . $group->id , 'style' => 'display: none']) !!}
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 25, 'order' => false])
@endsection
