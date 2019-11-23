@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.characters'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.characters')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/characters/create') }}">
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
                        <th>Views</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($characters as $character)
                    <tr>
                        <td class="text-center">
                            <img class="" src="{{ $character->image }}" alt="{{ $character->name }}" width="70px">
                        </td>
                        <td class="">{{ $character->name }}</td>
                        <td>
                            <span class="badge badge-info">{{ $character->views }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('staff/characters/' . $character->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Personagem"><i class="fas fa-pencil-alt text-info"></i> Editar</a>
                                <a href="javascript:;" onclick="document.getElementById('character-del-{{ $character->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Personagem"><i class="fa fa-times text-danger"></i> Deletar</a>
                                {!! Form::open(['url' => 'staff/characters/' . $character->id, 'method' => 'DELETE', 'id' => 'character-del-' . $character->id , 'style' => 'display: none']) !!}
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
