@extends('layouts.dashboard')

@section('title', 'Pesquisa')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pesquisa</li>
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
                        <h4 class="card-title">Pesquisa: {{ $poll->name }}</h4>

                        {!! $poll->descriptionHtml() !!}
                        <hr>

                        {!! Form::open(['url' => route('site.poll.vote', [$poll->id, $poll->slug]), 'class' => 'form-horizontal mt-4']) !!}
                            @foreach ($poll->options as $option)
                                <div class="form-group">
                                @if($poll->multivote)
                                    <label for="option-checkbox-{{ $option->id }}"></label>
                                    <input type="checkbox" id="option-checkbox-{{ $option->id }}" name="option[]" value="{{ $option->id }}"> {{ $option->name }}
                                @else
                                    <label for="option-radio-{{ $option->id }}"></label>
                                    <input type="radio" id="option-radio-{{ $option->id }}" name="option" value="{{ $option->id }}"> {{ $option->name }}
                                @endif
                                </div>
                            @endforeach
                        {!! Form::submit('Votar', ['class' => 'btn  btn-primary btn-rounded btn-outline']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
