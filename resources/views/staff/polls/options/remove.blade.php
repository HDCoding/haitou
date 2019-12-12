@extends('layouts.dashboard')

@section('title', 'Remover Opções')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/polls') }}">@lang('dashboard.polls')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Remover Opções</li>
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
                        <h4 class="card-title">Remover Opções - Pergunta: </b> {{ $poll->name }}</h4>
                        <p>Selecione apenas o que deseja deletar.</p>
                        @includeIf('errors.errors', [$errors])

                        {!! Form::open(['url' => 'staff/poll/options/remove', 'class' => 'form-horizontal push-5-t']) !!}
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 70px;"></th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($options as $option)
                                <tr>
                                    <td class="text-center">
                                        <label class="css-input css-checkbox css-checkbox-primary">
                                            <input type="checkbox" id="name" name="name[]" value="{{ $option->id }}"><span></span>
                                        </label>
                                    </td>
                                    <td>
                                        {{ $option->name }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        {!! Form::submit('Remover', ['class' => 'btn btn-rounded btn-outline-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
