@extends('layouts.dashboard')

@section('title', 'Pesquisas')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesquisas</li>
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
                        <h4 class="card-title">Resultado da pesquisa para "Membro"</h4>
                        <h6 class="card-subtitle">Cerca de 700 resultado (0.10 segundos)</h6>
                        <ul class="search-listing list-style-none">
                            @forelse($users as $user)
                            <li class="border-bottom p-t-15">
                                <h4 class="m-b-0">
                                    <a class="text-cyan font-medium p-0" href="{{ route('user.profile', ['slug' => $user->slug]) }}" target="_blank">{{ $user->username }}</a>
                                </h4>
                                <a href="javascript:void(0)" class="p-0 text-success">{{ '@'.$user->slug }}</a>
                                <p>{{ $user->info }}</p>
                            </li>
                            @empty
                                <li class="border-bottom p-t-15">
                                    <p class="text-center h4">Nenhum Membro encontrado.</p>
                                </li>
                            @endforelse
                        </ul>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
