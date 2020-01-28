@extends('layouts.dashboard')

@section('title', 'Top Leeched')

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
                            <li class="breadcrumb-item active" aria-current="page">Top Leeched</li>
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
                        <h4 class="card-title">Top Leeched</h4>
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
                                @foreach ($leeched as $key => $leech)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a class="font-weight-bold" href="{{ route('torrent.show', ['id' => $leech->id, 'slug' => $leech->slug]) }}">
                                                {{ $leech->name }}
                                            </a>
                                        </td>
                                        <td>{{ $leech->seeders }}</td>
                                        <td><span class="text-danger">{{ $leech->leechers }}</span></td>
                                        <td>{{ $leech->times_completed }}</td>
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
