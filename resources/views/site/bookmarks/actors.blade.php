@extends('layouts.dashboard')

@section('subtitle', 'Meus Favoritos')

@section('content')

    <h4 class="font-weight-bold py-3 mb-2">Atrizes/Atores Favoritos</h4>

    <div class="card">
        <div class="card-header">Atrizes/Atores Favoritos</div>
        <table class="table card-table">
            <thead class="thead-light">
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
                        <img class="" src="{{ $bookmark->actor->image }}" alt="{{ $bookmark->actor->name }}"
                             width="70px">
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
                            <span class="fas fa-times"></span>
                        </button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="pagination justify-content-center">
            {{ $bookmarks->links() }}
        </div>
    </div>

@endsection
