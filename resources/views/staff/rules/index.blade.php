@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.rules'))

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.rules')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <a href="{{ url('staff/rules/create') }}">
        <button type="button" class="btn btn-outline-primary">
            <span class="ion ion-md-add"></span> Adicionar
        </button>
    </a>

    <div id="rule">
        @foreach($rules as $rule)
        <div class="card mb-2">
            <div class="card-header">
                <a class="text-body" data-toggle="collapse" href="#rule-{{ $rule->id }}">
                    {{ $rule->name }}
                </a>
                <a href="{{ url('staff/rules', [$rule->id, 'edit']) }}" class="pt-3 ml-lg-5" data-toggle="tooltip" title="Editar" >
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="fa fa-pencil-alt"></span> Editar
                    </button>
                </a>
                <button type="button" class="btn btn-xs btn-outline-danger" data-toggle="tooltip" title="Deletar" onclick="document.getElementById('rule-del-{{$rule->id}}').submit();">
                    <span class="fa fa-trash"> Deletar</span>
                </button>
                {!! Form::open(['url' => 'staff/rules/' . $rule->id, 'method' => 'DELETE', 'id' => 'rule-del-' . $rule->id , 'style' => 'display: none', 'class' => 'form-vertical']) !!}
                {!! Form::close() !!}
            </div>

            <div id="rule-{{ $rule->id }}" class="collapse" data-parent="#rule">
                <div class="card-body">
                    {!! $rule->descriptionHtml() !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>

@endsection
