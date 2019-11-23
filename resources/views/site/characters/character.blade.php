@extends('layouts.dashboard')

@section('subtitle', $char->name)

@section('content')

    <div class="block">
        <div class="row">
            <div class="col-md-4">
                <!-- logo -->
                <div class="block block-rounded">
                    <img class="img-fluid" src="{{ $char->image }}" alt="Poster">
                </div>
                <!-- END logo -->

                <!-- Sobre -->
                <div class="block block-rounded">
                    <div class="block-header bg-gray-lighter text-center">
                        <h3 class="block-title">{{ $char->name }}</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-condensed">
                            <tbody>
                            @if($bookmarked)
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                        <button type="submit" class="btn icon-btn btn-outline-dark" data-toggle="tooltip" data-placement="top" title="Remover dos favoritos" data-original-title="Remover dos favoritos">
                                            <span class="fas fa-heartbeat"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('character_id', $char->id) !!}
                                        <button type="submit" class="btn icon-btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Adicionar aos favoritos" data-original-title="Adicionar aos favoritos">
                                            <span class="oi oi-heart"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- description -->
                <div class="block block-rounded">
                    <div class="block-content">
                        <table class="table table-striped table-borderless remove-margin-b">
                            <thead>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Nome:</td>
                                    <td>{{ $char->name }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Info:</b> {!! $char->descriptionHtml() !!}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END description -->
            </div>
        </div>
    </div>

@endsection
