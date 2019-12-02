@extends('layouts.dashboard')

@section('title', trans('dashboard.studios'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.studios')</li>
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
                        <h4 class="card-title">@lang('dashboard.studios')</h4>
                        <a href="{{ url('staff/studios/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Nome</th>
                                    <th class="text-center">Views</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($studios as $studio)
                                    <tr>
                                        <td class="text-center">{{ $studio->id }}</td>
                                        <td>{{ $studio->name }}</td>
                                        <td class="text-center">{{ $studio->views }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/studios/' . $studio->id . '/edit') }}" class="btn btn-xs" type="button" data-toggle="tooltip" title="Editar Estúdio"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a href="javascript:;" onclick="document.getElementById('studio-del-{{$studio->id}}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Estúdio"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/studios/' . $studio->id, 'method' => 'DELETE', 'id' => 'studio-del-' . $studio->id , 'style' => 'display: none']) !!}
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
