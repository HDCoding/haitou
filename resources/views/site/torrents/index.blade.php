@extends('layouts.dashboard')

@section('title', 'Torrents')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Torrents</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light text-center">
                        <b class="card-header-title">Pesquisar Torrents</b>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="name">Nome</label>
                                    <input type="text" class="form-control" name="name" id="name">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="fansub_id">Fansub</label>
                                    <select class="custom-select" name="fansub_id" id="fansub_id" data-style="form-control">
                                        <option value="null" disabled selected>Fansub</option>
                                        @foreach($fansubs as $fansub)
                                            <option value="{{ $fansub->id }}">{{ $fansub->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Checkboxes -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="text-light small mb-3">Categoria:</div>
                                    <div class="form-check-inline">
                                        @foreach($categories as $category)
                                            <label class="custom-control custom-checkbox form-check-inline" for="{{ $category->id }}">
                                                <input type="checkbox" class="custom-control-input" id="{{ $category->id }}" value="{{ $category->id }}">
                                                <span class="custom-control-label">{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-light small mb-3">Opções:</div>
                                    <div class="form-check-inline">
                                        <label class="custom-control custom-checkbox form-check-inline" for="is_freeleech">
                                            <input type="checkbox" class="custom-control-input" id="is_freeleech" value="is_freeleech">
                                            <span class="custom-control-label">Freeleech</span>
                                        </label>
                                        <label class="custom-control custom-checkbox form-check-inline" for="is_silver">
                                            <input type="checkbox" class="custom-control-input" id="is_silver" value="is_silver">
                                            <span class="custom-control-label">Silver</span>
                                        </label>
                                        <label class="custom-control custom-checkbox form-check-inline" for="is_doubleup">
                                            <input type="checkbox" class="custom-control-input" id="is_doubleup" value="is_doubleup">
                                            <span class="custom-control-label">DoubleUP</span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-secondary mt-4">Pesquisar</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Torrent info</th>
                                    <th class="text-center">
                                        <span class="fa fa-arrow-up text-success"></span>
                                        <a href="#" title="Ordenar por Seeds">Seeds</a>
                                    </th>
                                    <th class="text-center">
                                        <span class="fa fa-arrow-down text-danger"></span>
                                        <a href="#" title="Ordenar por Leechers">Leechers</a>
                                    </th>
                                    <th class="text-center">
                                        <span class="fa fa-check text-info"></span>
                                        <a href="#" title="Ordenar por Completado">Completado</a>
                                    </th>
                                    <th class="text-center">
                                        <a href="#" title="Ordenar por Tamanho">Tamanho</a>
                                    </th>
                                    <th class="text-center">
                                        <span class="fa fa-calendar-alt text-dark"></span>
                                        <a href="#" title="Ordenar por Data Upload">Data Upload</a>
                                    </th>
                                    <th class="text-center">Uploader</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($torrents as $torrent)
                                    <tr>
                                        <td class="col-md-7">
                                            <div class="media">
                                                <div class="media-left">
                                                    <img class="media-object" width="92px" height="130px" alt="Poster"
                                                         src="{{ $torrent->media->poster }}">
                                                </div>
                                                <div class="media-body">
                                                    <h5 class="media-heading ml-3">
                                                        {{ link_to_route('torrent.show', $torrent->name, [$torrent->id, $torrent->slug]) }}
                                                    </h5>

                                                    <div class="ml-3">{{ $torrent->media->name }}</div>

                                                    <div class="ml-3 mt-2">
                                                        <span class="badge badge-success text-uppercase mt-2 mr-2" title="Fansub"> {{ $torrent->fansub->name }} </span>
                                                    </div>

                                                    <div class="ml-3">
                                                        <span class="badge badge-info badge-outline-info" title="Categoria">{{ $torrent->category->name }}</span>
                                                        {!! $torrent->freeleech() !!}
                                                        {!! $torrent->silver() !!}
                                                        {!! $torrent->doubleUp() !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-md-1 text-center">{{ $torrent->seeders }}</td>
                                        <td class="col-md-1 text-center">{{ $torrent->leechers }}</td>
                                        <td class="col-md-1 text-center">{{ $torrent->times_completed }}</td>
                                        <td class="col-md-1 text-center">{{ $torrent->size() }}</td>
                                        <td class="col-md-1 text-center">{{ format_date($torrent->created_at) }}</td>
                                        <td class="col-md-1 text-center">{{ $torrent->uploader() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $torrents->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
