@extends('layouts.dashboard')

@section('title', $actor->name)

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $actor->name }}</li>
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
                        <h3 class="card-title">{{ $actor->name }}</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="white-box text-center">
                                    <img class="img-fluid img-responsive" src="{{ $actor->image() }}" alt="Poster" width="300px">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title m-t-40">Info</h4>
                                <p>{!! $actor->descriptionHtml() !!}</p>
                                <h5 class="m-t-40">Favoritos</h5>
                                @if($bookmarked)
                                    {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                    <button type="submit" class="btn icon-btn btn-dark" data-toggle="tooltip" data-placement="top" title="Remover dos favoritos">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                    {!! Form::hidden('actor_id', $actor->id) !!}
                                    <button type="submit" class="btn icon-btn btn-info" data-toggle="tooltip" data-placement="top" title="Adicionar aos favoritos">
                                        <i class="fas fa-star"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
