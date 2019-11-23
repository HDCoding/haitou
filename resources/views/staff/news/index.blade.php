@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.news'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.news')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="{{ url('staff/news/create') }}">
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
                        <th>
                            <i class="fa fa-suitcase text-gray"></i> @lang('dashboard.news')
                        </th>
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

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 50, 'order' => true])
@endsection
