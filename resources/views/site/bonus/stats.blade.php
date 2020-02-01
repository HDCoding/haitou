@extends('layouts.dashboard')

@section('title', 'Bônus')

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
                            <li class="breadcrumb-item active" aria-current="page">Pontos</li>
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
                        <h4 class="card-title">Pontos</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Descrição</th>
                                    <th>Pontos</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th><b>Por se cadastrar</b></th>
                                    <td><b class="text-info">{{ setting('points_signup') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Convites aceitos</b></td>
                                    <td><b class="text-info">{{ setting('points_invite') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Completou download P2P</b></td>
                                    <td><b class="text-info">{{ setting('points_download') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Comentários (Torrent, Mídias, etc)</b></td>
                                    <td><b class="text-info">{{ setting('points_comment') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Upload arquivo Torrent</b></td>
                                    <td><b class="text-info">{{ setting('points_upload') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Votar na mídias</b></td>
                                    <td><b class="text-info">{{ setting('points_rating') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Criar novos tópicos</b></td>
                                    <td><b class="text-info">{{ setting('points_topic') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Postar nos tópicos</b></td>
                                    <td><b class="text-info">{{ setting('points_post') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Mantendo os site limpo (deletando post, comentários, eventos tóxicos)</b></td>
                                    <td><b class="text-info">{{ setting('points_delete') }}</b></td>
                                </tr>

                                <tr>
                                    <td><b>Por agradecimentos</b></td>
                                    <td><b class="text-info">{{ setting('points_tdanks') }}</b></td>
                                </tr>
                                <tr>
                                    <td><b>Reportar (post, perfil, comentário, etc)</b></td>
                                    <td><b class="text-info">{{ setting('points_report') }}</b></td>
                                </tr>
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
                        <h3 class="card-title text-danger text-center">Aviso</h3>
                        <hr>
                        <h3 class="card-subtitle text-center text-primary">
                            Nessa taxa de ganho, você ganhará o seguinte por ações.
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
