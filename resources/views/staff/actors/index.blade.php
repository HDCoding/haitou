@extends('layouts.dashboard')

@section('title', trans('dashboard.actors'))

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
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center"><i class="fas fa-user"></i></th>
                                    <th>Nome</th>
                                    <th>Views</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($actors as $actor)
                                    <tr class="odd gradeX">
                                        <td class="text-center">
                                            <img class="" src="{{ $actor->image }}" alt="{{ $actor->name }}" width="70px">
                                        </td>
                                        <td class="">{{ $actor->name }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $actor->views }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/actors/' . $actor->id . '/edit') }}" data-toggle="tooltip" title="Editar Atriz/Ator">
                                                    <button type="button" class="btn btn-xs btn-outline-primary">
                                                        <span class="fas fa-pencil-alt"></span> Editar
                                                    </button>
                                                </a>
                                                <a href="javascript:;" onclick="document.getElementById('actor-del-{{ $actor->id }}').submit();" data-toggle="tooltip" title="Remover Atriz/Ator">
                                                    <button type="button" class="btn btn-xs btn-outline-danger">
                                                        <span class="fas fa-times"></span> Deletar
                                                    </button>
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
