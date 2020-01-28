@extends('layouts.dashboard')

@section('title', 'Seed Size')

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
                            <li class="breadcrumb-item active" aria-current="page">Seed Size</li>
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
                        <h4 class="card-title">Seed Size</h4>
                        @include('site.stats.users.block_user_menu')
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Membro</th>
                                    <th>Seed Size</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($seedsizes as $key => $seedsize)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td {{ auth()->user()->username == $seedsize->user->username ? 'class=bg-success' : '' }}>
                                            @if ($seedsize->user->show_profile == false)
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <span class="text-orange">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        Escondido
                                                    </span>
                                                    @if (auth()->user()->id == $seedsize->user->id || auth()->user()->can('usuarios-mod'))
                                                        <a href="{{ route('user.profile', ['slug' => $seedsize->user->slug]) }}">({{ $seedsize->user->username }})</a>
                                                    @endif
                                                 </span>
                                            @else
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <a href="{{ route('user.profile', ['slug' => $seedsize->user->slug]) }}">{{ $seedsize->user->username }}</a>
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-primary"></span>
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
