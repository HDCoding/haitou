@extends('layouts.dashboard')

@section('title', trans('dashboard.news'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.news')</li>
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
                        <h4 class="card-title">@lang('dashboard.news')</h4>
                        <a href="{{ url('staff/news/create') }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th><i class="fa fa-suitcase text-gray"></i>#</th>
                                    <th>Título</th>
                                    <th>Por</th>
                                    <th>Views</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr class="odd gradeX">
                                        <td>#{{ $new->id }}</td>
                                        <td class="">{{ $new->name }}</td>
                                        <td class="">{{ $new->staff->name }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $new->views }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="{{ url('staff/news/' . $new->id . '/edit') }}" data-toggle="tooltip" title="Editar News">
                                                    <button type="button" class="btn btn-xs btn-outline-primary">
                                                        <span class="fas fa-pencil-alt"></span> Editar
                                                    </button>
                                                </a>
                                                <a href="javascript:;" onclick="document.getElementById('news-del-{{ $new->id }}').submit();"  data-toggle="tooltip" title="Remover News">
                                                    <button type="button" class="btn btn-xs btn-outline-danger">
                                                        <span class="fas fa-times"></span> Deletar
                                                    </button>
                                                </a>
                                                {!! Form::open(['url' => 'staff/news/' . $new->id, 'method' => 'DELETE', 'id' => 'news-del-' . $new->id , 'style' => 'display: none']) !!}
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
