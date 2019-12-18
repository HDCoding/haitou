@extends('layouts.dashboard')

@section('title', 'Meus Favoritos')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Atrizes/Atores Favoritos</li>
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
                        <h4 class="card-title">Atrizes/Atores Favoritos</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th class="text-center">Remover Favoritos?</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bookmarks as $bookmark)
                                    <tr>
                                        <td>
                                            <img class="" src="{{ $bookmark->actor->image }}" alt="{{ $bookmark->actor->name }}" width="70px">
                                        </td>
                                        <td>
                                            <a href="{{ route('actors.show', [$bookmark->actor->id, $bookmark->actor->slug]) }}"
                                               target="_blank">{{ $bookmark->actor->name }}</a>
                                        </td>
                                        <td class="text-center">
                                            {!! Form::open(['route' => ['delete.bookmark', $bookmark->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                            <button type="submit" class="btn btn-xs icon-btn btn-outline-danger" data-toggle="tooltip"
                                                    data-placement="top" title="Remover dos favoritos"
                                                    data-original-title="Remover dos favoritos">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $bookmarks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
