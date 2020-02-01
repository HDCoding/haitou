@extends('layouts.dashboard')

@section('title', 'Bônus')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Bônus</h4>
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
                        <h4 class="card-title">Bônus</h4>
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
                                        <td><b>{{ $point->name }}</b></td>
                                        <td><span class="badge badge-success">{{ $point->cost }}</span></td>
                                        <td class="hidden-xs">
                                            {!! Form::open(['url' => 'bonus/'.$point->id.'/exchange']) !!}
                                            {!! Form::submit('Escolher', ['class' => 'btn btn-primary btn-xs btn-rounded']) !!}
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
                            Trocas são finais, por favor, verifique suas escolhas antes de fazer uma troca.
                        </h3>
                        <h2 class="text-danger text-center">SEM REEMBOLSO!</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
