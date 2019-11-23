@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.medias'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.medias')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/medias/create') }}">
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
                    <th class="text-center"><i class="si si-user"></i></th>
                    <th>Categoria</th>
                    <th>Nome</th>
                    <th class="hidden-xs">Genero</th>
                    <th class="hidden-xs">Views</th>
                    <th class="hidden-xs">Estudio</th>
                    <th class="text-center">Opções</th>
                </tr>
                </thead>
                <tbody>
                @foreach($medias as $media)
                    <tr>
                        <td class="text-center">
                            <img class="" src="{{ $media->poster }}" alt="{{ $media->name }}" width="70px">
                        </td>
                        <td>{{ $media->category->name }}</td>
                        <td class="">{{ $media->name }}</td>
                        <td>{!! $media->getGenre() !!}</td>
                        <td>
                            <span class="badge badge-info">{{ $media->views }}</span>
                        </td>
                        <td>{{ $media->studio->name }}</td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="{{ url('staff/media/' . $media->id . '/casts') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Casts"><i class="fas fa-users text-warning"></i></a>
                                <a href="{{ url('staff/medias/' . $media->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Mídia"><i class="fas fa-pencil-alt text-info"></i></a>
                                <a href="javascript:;" onclick="document.getElementById('media-del-{{ $media->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Mídia"><i class="fa fa-times text-danger"></i></a>
                                {!! Form::open(['url' => 'staff/medias/' . $media->id, 'method' => 'DELETE', 'id' => 'media-del-' . $media->id , 'style' => 'display: none']) !!}
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
