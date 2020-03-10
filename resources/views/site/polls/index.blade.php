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
                <a href="{{ route('site.polls.create') }}" class="btn btn-xs btn-primary">
                    <i class="ion ion-md-add"></i> Adicionar
                </a>
                <h5 class="card-title text-muted mt-3 mb-3">
                    Pesquisas realizadas pelos próprios membros, não condizem com as pesquisas do Fórum.
                </h5>

                <div class="row">

                    @forelse($polls as $poll)
                        <div class="col-sm-12 col-lg-4">
                            <div class="card poll-widget">
                                <div class="card-body">
                                    <h4 class="card-title">{{ $poll->user->username }}</h4>
                                    <p class="font-bold text-muted">{{ $poll->name }}</p>
                                    <ul class="list-style-none m-t-20">
                                        @foreach($poll->options->take(4) as $option)
                                        <li class="m-t-20">
                                            @if($poll->multi_choice)
                                                <!-- Arrumar layout depois, primeira checar se funciona -->
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="option-checkbox-{{ $option->id }}" name="option[]" value="{{ $option->id }}"> {{ $option->name }}
                                                    <label for="option-checkbox-{{ $option->id }}"></label>
                                                </div>
                                            @else
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option-radio-{{ $option->id }}" name="option" value="{{ $option->id }}"> {{ $option->name }}
                                                    <label for="option-radio-{{ $option->id }}"></label>
                                                </div>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    <a href="{{ route('site.poll.show', [$poll->id, $poll->slug]) }}" class="btn btn-success m-t-15">
                                        Votar
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12">
                            <h5 class="text-center">Nenhuma pesquisa no momento, adicione a sua :P</h5>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

@endsection
