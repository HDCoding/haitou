@extends('layouts.dashboard')

@section('title', 'Top Completed')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('statistics') }}">Estatísticas</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Top Completed</li>
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
                        <h4 class="card-title">Top Completed</h4>
                        @include('site.stats.torrents.block_torrent_menu')
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Torrent</th>
                                    <th>Seeders</th>
                                    <th>Leechers</th>
                                    <th>Completado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($completed as $key => $complete)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a class="font-weight-bold" href="{{ route('torrent.show', ['id' => $complete->id, 'slug' => $complete->slug]) }}">
                                                {{ $complete->name }}
                                            </a>
                                        </td>
                                        <td>{{ $complete->seeders }}</td>
                                        <td>{{ $complete->leechers }}</td>
                                        <td><span class="text-primary">{{ $complete->times_completed }}</span></td>
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
