@extends('layouts.dashboard')

@section('title', 'Top Level')

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
                            <li class="breadcrumb-item active" aria-current="page">Top Level</li>
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
                        <h4 class="card-title">Top Level</h4>
                        @include('site.stats.users.block_user_menu')
                        <div class="table-responsive m-t-15">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Membro</th>
                                    <th>Level</th>
                                    <th><i class="fas fa-shield-alt"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($levels as $key => $level)
                                    <tr>
                                        <td class="align-middle">{{ ++$key }}</td>
                                        <td class="align-middle {{ auth()->user()->username == $level->username ? 'bg-success' : '' }}">
                                            @if ($level->show_profile == false)
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <span class="text-orange">
                                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                                        Escondido
                                                    </span>
                                                    @if (auth()->user()->id == $level->id || auth()->user()->can('usuarios-mod'))
                                                        <a href="{{ route('user.profile', ['slug' => $level->slug]) }}">({{ $level->username }})</a>
                                                    @endif
                                                 </span>
                                            @else
                                                <span class="badge badge-pill badge-light font-weight-bold">
                                                    <a href="{{ route('user.profile', ['slug' => $level->slug]) }}">{{ $level->username }}</a>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="align-middle">
                                            <span class="text-success">{{ $level->level() }}</span>
                                        </td>
                                        <td class="align-middle">
                                            <img src="{{ $level->levelImage() }}" class="d-block ui-w-40" alt="Level">
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
