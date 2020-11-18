@extends('layouts.dashboard')

@section('title', 'Bônus')

@section('css')
    <!-- select2 -->
    <link href="{{ secure_asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('bonus') }}">Bônus</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Doar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @include('site.bonus.block_buttons')
        @includeIf('errors.errors', [$errors])
        @include('includes.messages')
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Doar pontos</h4>
                        <h6 class="card-subtitle">Ta com pontos sobrando, doe para seus amigos.</h6>
                        <div class="ui-bordered px-4 pt-4 mb-4">
                            {!! Form::open(['route' => 'bonus.donate', 'class' => 'form-horizontal']) !!}
                                <div class="col-md-12">
                                    {!! Form::label('user_id', 'Membro:', ['class' => 'form-label']) !!}
                                    {!! Form::select('user_id', $members, null, ['class' => 'custom-select select2', 'required', 'size' => 10]) !!}
                                </div>
                                <div class="col-md-12">
                                    {!! Form::label('quantity', 'Quantidade:', ['class' => 'form-label']) !!}
                                    {!! Form::number('quantity', null, ['class' => 'form-control', 'min' => 1, 'required']) !!}
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label d-none d-md-block">&nbsp;</label>
                                    <button type="submit" class="btn btn-secondary btn-block btn-rounded">Doar</button>
                                </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Seus Pontos</h4>
                        <h2 class="text-info font-bold m-b-5 text-center">{{ auth()->user()->points() }}</h2>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <h2 class="card-title text-danger text-center">Aviso</h2>
                        <hr>
                        <h3 class="card-subtitle text-center text-orange">
                            Envios são finais, por favor, verifique suas escolhas antes de fazer uma troca.
                        </h3>
                        <h2 class="text-danger text-center">SEM REEMBOLSO!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ secure_asset('vendor/select2/dist/js/select2.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".select2").select2({
                placeholder: "Selecione um membro",
                allowClear: true
            });
        });
    </script>
@endsection
