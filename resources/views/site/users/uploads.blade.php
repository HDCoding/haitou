@extends('layouts.dashboard')

@section('subtitle', 'Meus Uploads')

@section('content')

    <div class="font-weight-bold h4 py-3 mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">Meus Uploads</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header">Meus Uploads</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Nome</th>
                    <th>Categoria</th>
                    <th>Tamanho</th>
                    <th>Seeders</th>
                    <th>Leechers</th>
                    <th>Completado</th>
                    <th>Upado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($uploads as $upload)
                    <tr>
                        <td>
                            <a href="{{ route('torrent.show', ['id' => $upload->id, 'slug' => $upload->slug]) }}"
                               target="_blank">
                                {{ $upload->name }}
                            </a>
                            <div class="pull-right">
                                <a href="{{ route('torrent.download', ['id' => $upload->id]) }}">
                                    <button class="btn btn-xs btn-primary btn-round" type="button">
                                        <i class="fas fa-download"></i>
                                    </button>
                                </a>
                            </div>
                        </td>
                        <td>
                            {{ $upload->category->name }}
                        </td>
                        <td>
                            <span class="badge badge-info font-weight-bold"> {{ $upload->getSize() }}</span>
                        </td>
                        <td>
                            <span class="badge badge-success font-weight-bold"> {{ $upload->seeders }}</span>
                        </td>
                        <td>
                            <span class="badge badge-danger font-weight-bold"> {{ $upload->leechers }}</span>
                        </td>
                        <td>
                            <span class="badge badge-warning font-weight-bold"> {{ $upload->times_completed }}</span>
                        </td>
                        <td>
                            {{ ($upload->created_at ? $upload->created_at->diffForHumans() : 'N/A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination justify-content-center">
            {{ $uploads->links() }}
        </div>

    </div>

@endsection
