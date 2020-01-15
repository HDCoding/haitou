@extends('layouts.dashboard')

@section('title', 'Notícia')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $new->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Notícia
            </div>
            <div class="card-body collapse show">
                <h4 class="card-title mb-4">Notícia</h4>
                {!! $new->descriptionHtml() !!}
            </div>
        </div>
    </div>

@endsection
