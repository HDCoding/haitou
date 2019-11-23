@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.faqs'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.faqs')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="demo-vertical-spacing">
        @includeIf('errors.errors', [$errors])
        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-faq">
                <a href="{{ url('staff/faqs/create') }}" class="btn btn-outline-primary mb-4"><i class="fas fa-plus"></i> Adicionar Pergunta</a>
                @forelse($categories as $category)
                    <div class="card mb-5">
                        <div class="card-header h5">{{ $category->name }}</div>
                        <table class="table card-table">
                            <thead class="thead-light">
                                <tr>
                                    <th class="text-center" style="width: 50px;">#</th>
                                    <th>Pergunta</th>
                                    <th style="width: 15%;">Ativado</th>
                                    <th class="text-center" style="width: 100px;">Opções</th>
                                </tr>
                            </thead>
                            <tbody>
                            @forelse($faqs as $faq)
                                @if($faq->category_id == $category->id)
                                    <tr>
                                        <td class="text-center" scope="row">{{ $faq->id }}</td>
                                        <td>{{ $faq->question }}</td>
                                        <td>{!! $faq->enabled() !!}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('faq-disable-{{ $faq->id }}').submit();" class="btn btn-xs btn-default" type="button">
                                                    @if($faq->is_enabled)
                                                        <i class="fa fa-pause text-warning" data-toggle="tooltip" title="Desativar Pergunta"></i>
                                                    @else
                                                        <i class="fa fa-play text-success" data-toggle="tooltip" title="Ativar Pergunta"></i>
                                                    @endif
                                                </a>
                                                {!! Form::open(['url' => 'faq/'.$faq->id.'/update/', 'method' => 'PUT', 'id' => 'faq-disable-' . $faq->id, 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                                <a href="{{ url('staff/faqs/' . $faq->id . '/edit') }}" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Pergunta"><i class="fa fa-pencil-alt text-info"></i></a>
                                                <a href="javascript:;" onclick="document.getElementById('faq-del-{{$faq->id}}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Pergunta"><i class="fa fa-times text-danger"></i></a>
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
                @empty
                    <p class="text-center">Nenhuma categoria cadastrada até o momento</p>
                @endforelse
            </div>

        </div>
    </div>

@endsection
