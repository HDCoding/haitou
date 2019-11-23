@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.studios'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.studios')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/studios/create') }}">
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
                                <a href="{{ url('staff/studios/' . $studio->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Estúdio"><i class="fas fa-pencil-alt text-info"></i></a>
                                <a href="javascript:;" onclick="document.getElementById('studio-del-{{$studio->id}}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Estúdio"><i class="fa fa-times text-danger"></i></a>
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 100, 'order' => false])
@endsection
