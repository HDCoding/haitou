@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.actors'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.actors')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/actors/create') }}">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered data-table">
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 50, 'order' => false])
@endsection
