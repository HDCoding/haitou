@extends('layouts.dashboard')

@section('title', 'Bônus')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Bônus</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Doar meus pontos</h4>
                        <h6 class="card-subtitle">Ta com pontos sobrando, doe para seus amigos.</h6>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="ui-bordered px-4 pt-4 mb-4">
                            {!! Form::open(['url' => 'bonus/donate']) !!}
                            <div class="form-row align-items-center">
                                <div class="col-md mb-4">
                                    {!! Form::label('user_id', 'Membro:', ['class' => 'form-label']) !!}
                                    {!! Form::select('user_id', $members, null, ['class' => 'custom-select select2', 'required']) !!}
                                </div>
                                <div class="col-md mb-4">
                                    {!! Form::label('quantity', 'Quantidade:', ['class' => 'form-label']) !!}
                                    {!! Form::number('quantity', null, ['class' => 'form-control', 'min' => 1, 'required']) !!}
                                </div>
                                <div class="col-md col-xl-2 mb-4">
                                    <label class="form-label d-none d-md-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-secondary btn-block">Doar</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Aviso</h4>
                        <h6 class="card-subtitle">
                            Trocas são finais, por favor, verifique suas escolhas antes de fazer uma troca.
                            <b class="text-danger">SEM REEMBOLSO!</b>
                        </h6>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Custo</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($points as $point)
                                    <tr>
                                        <td>
                                            <p><strong>{{ $point->name }}</strong></p>
                                            <p class="text-muted">{{ $point->description }}</p>
                                        </td>
                                        <td><span class="badge badge-outline-success">{{ $point->cost }}</span></td>
                                        <td class="hidden-xs">
                                            {!! Form::open(['url' => 'bonus']) !!}
                                            {!! Form::hidden('bonus_id', $point->id) !!}
                                            {!! Form::submit('Escolher', ['class' => 'btn btn-primary btn-outline-primary', 'data-toggle' => 'tooltip', 'title' => 'Escolher']) !!}
                                            {!! Form::close() !!}
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

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "Selecione um membro",
                allowClear: true
            });
        });
    </script>
@endsection
