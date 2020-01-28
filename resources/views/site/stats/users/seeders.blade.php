@extends('layouts.dashboard')

@section('title', 'Top Seeders')

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
                            <li class="breadcrumb-item active" aria-current="page">Top Seeders</li>
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
                        <h4 class="card-title">Top Seeders</h4>
                        @include('site.stats.users.block_user_menu')
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Membro</th>
                                    <th>Seeding</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($seeders as $key => $seeder)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td {{ auth()->user()->username == $seeder->user->username ? 'class=bg-success' : '' }}>
                                            @if ($seeder->user->show_profile == false)
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <span class="text-orange">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        Escondido
                                                    </span>
                                                    @if (auth()->user()->id == $seeder->user->id || auth()->user()->can('usuarios-mod'))
                                                        <a href="{{ route('user.profile', ['slug' => $seeder->user->slug]) }}">({{ $seeder->user->username }})</a>
                                                    @endif
                                                 </span>
                                            @else
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <a href="{{ route('user.profile', ['slug' => $seeder->user->slug]) }}">{{ $seeder->user->username }}</a>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-green">{{ $seeder->user->seeding() }}</span>
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
