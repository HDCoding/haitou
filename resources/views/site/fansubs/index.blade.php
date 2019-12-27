@extends('layouts.dashboard')

@section('title', 'Fansubs')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Fansubs</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @foreach($fansubs as $fansub)
                <div class="card mb-4 ml-2 mr-2" style="max-width: 20rem;">
                    <img class="card-img-top" src="{{ $fansub->logo }}" alt="Logo">
                    <div class="card-body">
                        <h4 class="card-title">{{ $fansub->name }}</h4>
                        <a class="btn btn-primary btn-rounded" href="{{ route('fansub.show', [$fansub->id, $fansub->slug]) }}">Visualizar</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
