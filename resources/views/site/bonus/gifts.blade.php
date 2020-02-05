@extends('layouts.dashboard')

@section('title', 'Bônus')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('bonus') }}">Bônus</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Presentes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @include('site.bonus.block_buttons')
        @includeIf('errors.errors', [$errors])
        @include('includes.messages')
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Presentes</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Remetente</th>
                                    <th>Destinatário</th>
                                    <th>Pontos</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $bonus)
                                    <tr>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => $bonus->user->slug]) }}">
                                                <span class="{{ auth()->user()->id !== $bonus->user->id ? 'text-primary' : 'text-info' }} font-weight-bold">{{ $bonus->user->username }}</span>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => $bonus->member->slug]) }}">
                                                <span class="{{ auth()->user()->id !== $bonus->user->id ? 'text-info' : 'text-primary' }} font-weight-bold">{{ $bonus->member->username }}</span>
                                            </a>
                                        </td>
                                        <td>{{ $bonus->cost }}</td>
                                        <td>{{ $bonus->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Seus Pontos</h4>
                        <h3 class="text-info font-bold m-b-5 text-center">{{ auth()->user()->points() }}</h3>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-body">
                        <h4 class="card-title text-center">Em Total de Bônus</h4>
                        <div class="well well-sm text-center mt-4">
                            <h4>Você recebeu: <strong class="text-success">{{ $received }}</strong></h4>
                            <h4>Você enviou: <strong class="text-orange">{{ $sent }}</strong></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
