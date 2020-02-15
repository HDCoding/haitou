@extends('layouts.dashboard')

@section('title', trans('dashboard.faqs'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.faqs')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <a href="{{ url('staff/faqs/create') }}" class="btn btn-primary m-b-4 m-l-15 mb-3">
                <i class="fas fa-plus"></i> Adicionar Pergunta
            </a>
            @includeIf('errors.errors', [$errors])
            @include('includes.messages')
            @forelse($categories as $category)
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $category->name }}</h4>
                    </div>
                    <table class="table m-b-0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Pergunta</th>
                            <th>Ativado</th>
                            <th class="text-center">Opções</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($faqs as $faq)
                            @if($faq->category_id == $category->id)
                                <tr>
                                    <th>{{ $faq->id }}</th>
                                    <td>{{ $faq->question }}</td>
                                    <td>{!! $faq->enabled() !!}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="javascript:;" onclick="document.getElementById('faq-disable-{{ $faq->id }}').submit();">
                                                @if($faq->is_enable)
                                                    <i class="fa fa-pause text-warning" data-toggle="tooltip" title="Desativar Pergunta"></i>
                                                @else
                                                    <i class="fa fa-play text-success" data-toggle="tooltip" title="Ativar Pergunta"></i>
                                                @endif
                                            </a>
                                            {!! Form::open(['url' => 'faq/'.$faq->id.'/update/', 'method' => 'PUT', 'id' => 'faq-disable-' . $faq->id, 'style' => 'display: none']) !!}
                                            {!! Form::close() !!}
                                            <a class="m-l-15" href="{{ url('staff/faqs/' . $faq->id . '/edit') }}" data-toggle="tooltip" title="Editar Pergunta"><i class="fa fa-pencil-alt text-info"></i></a>
                                            <a class="m-l-15" href="javascript:;" onclick="document.getElementById('faq-del-{{ $faq->id }}').submit();" data-toggle="tooltip" title="Remover Pergunta"><i class="fa fa-times text-danger"></i></a>
                                            {!! Form::open(['url' => 'staff/faqs/' . $faq->id, 'method' => 'DELETE', 'id' => 'faq-del-' . $faq->id, 'style' => 'display: none']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Nenhuma pergunta cadastrada até o momento</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @empty
                <p class="text-center">Nenhuma categoria cadastrada até o momento</p>
            @endforelse
        </div>
    </div>

@endsection
