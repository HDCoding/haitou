@extends('layouts.dashboard')

@section('subtitle', 'Fansubs')

@section('content')

    <div class="container-fluid flex-grow-1 container-p-y">

        <div class="font-weight-bold py-3 h4">
            <span class="text-muted font-weight-light">Fansubs</span>
        </div>

        <div class="row">
            @foreach($fansubs as $fansub)
                <div class="card mb-4 ml-2 mr-2" style="max-width: 20rem;">
                    <img class="card-img-top" src="{{ $fansub->logo }}" alt="Logo">
                    <div class="card-body">
                        <h4 class="card-title">{{ $fansub->name }}</h4>
                        <a href="{{ route('fansub.show', [$fansub->id, $fansub->slug]) }}" class="btn btn-primary btn-outline-primary">Visualizar</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
