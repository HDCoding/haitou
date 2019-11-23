@extends('layouts.dashboard')

@section('subtitle', 'Pesquisas')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/polls') }}">Pesquisas</a>
            </li>
            <li class="breadcrumb-item active">Remover Opções</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header"><b>Pergunta: </b> {{ $poll->name }}</h6>
        <div class="card-body">
            <p>Selecione apenas o que deseja deletar.</p>

            @includeIf('errors.errors', [$errors])
            <div class="block-content">
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
                                    <input type="checkbox" id="option" name="option[]" value="{{ $option->id }}"><span></span>
                                </label>
                            </td>
                            <td>
                                {{ $option->option }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <br>
                {!! Form::submit('Remover', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                <br>
                {!! Form::close() !!}

            </div>
        </div>

    </div>

@endsection
