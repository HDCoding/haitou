@extends('layouts.dashboard')

@section('title', $character->name)

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $character->name }}</li>
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
                        <h3 class="card-title">{{ $character->name }}</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="white-box text-center">
                                    <img src="{{ $character->image() }}" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title m-t-40">Info</h4>
                                <p>{!! $character->descriptionHtml() !!}</p>
                                @if($bookmarked)
                                    {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                    <button type="submit" class="btn icon-btn btn-outline-dark btn-rounded" data-toggle="tooltip" data-placement="top" title="Remover dos favoritos" data-original-title="Remover dos favoritos">
                                        <i class="fas fa-heartbeat"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                    {!! Form::hidden('character_id', $character->id) !!}
                                    <button type="submit" class="btn icon-btn btn-outline-danger btn-rounded m-r-5" data-toggle="tooltip" data-placement="top" title="Adicionar aos favoritos" data-original-title="Adicionar aos favoritos">
                                        <i class="oi oi-heart"></i>
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
