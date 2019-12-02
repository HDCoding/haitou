@extends('layouts.dashboard')

@section('title', trans('dashboard.torrents'))

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.torrents')</li>
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
                        <h4 class="card-title">@lang('dashboard.torrents')</h4>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Categoria</th>
                                    <th>Nome</th>
                                    <th>Tamanho</th>
                                    <th>Views</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($torrents as $torrent)
                                    <tr>
                                        <td class="text-center">{{ $torrent->id }}</td>
                                        <td class="">{{ $torrent->category->name }}</td>
                                        <td class="">{{ $torrent->name }}</td>
                                        <td class="">{{ $torrent->getSize() }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $torrent->views }}</span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button class="btn" type="button">Opções</button>
                                                <div class="btn-group">
                                                    <button class="btn dropdown-toggle" data-toggle="dropdown"
                                                            aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li class="dropdown-header">Torrent</li>
                                                        <li>
                                                            <a tabindex="-1" href="{{ url('staff/torrents/' . $torrent->id . '/edit') }}"><i class="fa fa-pencil text-info"></i> Editar Torrent</a>
                                                        </li>
                                                        <li class="divider"></li>
                                                        <li class="dropdown-header">Opções</li>
                                                        <li>
                                                            <a tabindex="-1" href="javascript:;" onclick="document.getElementById('file-freeleech-{{ $torrent->id }}').submit();"><i class="fa fa-download text-info"></i>
                                                                Freeleech @if($torrent->is_freeleech) <i class="fa fa-check text-success"></i> @endif </a>
                                                            {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/freeleech', 'method' => 'PUT', 'id' => 'file-freeleech-' . $torrent->id , 'style' => 'display: none']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                        <li>
                                                            <a tabindex="-1" href="javascript:;" onclick="document.getElementById('file-silver-{{ $torrent->id }}').submit();"><i class="fa fa-star-half-empty text-default"></i>
                                                                Silver @if($torrent->is_silver) <i class="fa fa-check text-success"></i> @endif </a>
                                                            {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/silver', 'method' => 'PUT', 'id' => 'file-silver-' . $torrent->id , 'style' => 'display: none']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                        <li>
                                                            <a tabindex="-1" href="javascript:;" onclick="document.getElementById('file-doubleup-{{ $torrent->id }}').submit();"><i class="fa fa-forward text-warning"></i> Double
                                                                UP @if($torrent->is_doubleup) <i class="fa fa-check text-success"></i> @endif </a>
                                                            {!! Form::open(['url' => 'staff/torrent/' . $torrent->id . '/doubleup', 'method' => 'PUT', 'id' => 'file-doubleup-' . $torrent->id , 'style' => 'display: none']) !!}
                                                            {!! Form::close() !!}
                                                        </li>

                                                        <li class="divider"></li>
                                                        <li>
                                                            <a tabindex="-1" href="javascript:;" onclick="document.getElementById('file-del-{{ $torrent->id }}').submit();"><i class="fa fa-times text-danger"></i> Remover Torrent</a>
                                                            {!! Form::open(['url' => 'staff/torrents/' . $torrent->id, 'method' => 'DELETE', 'id' => 'file-del-' . $torrent->id , 'style' => 'display: none']) !!}
                                                            {!! Form::close() !!}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
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
