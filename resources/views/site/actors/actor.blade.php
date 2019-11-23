@extends('layouts.dashboard')

@section('subtitle', $actor->name)

@section('content')

    <div class="block">
        <div class="row">
            <div class="col-md-4">
                <!-- logo -->
                <div class="block block-rounded">
                    <img class="img-fluid" src="{{ $actor->image }}" alt="Poster">
                </div>
                <!-- END logo -->

                <!-- Sobre -->
                <div class="block block-rounded">
                    <div class="block-header bg-gray-lighter text-center">
                        <h3 class="block-title">{{ $actor->name }}</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-condensed">
                            <tbody>
                            @if($bookmarked)
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                        <button type="submit" class="btn icon-btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Remover dos favoritos" data-original-title="Remover dos favoritos">
                                            <span class="fas fa-heartbeat"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td>
                                        {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('actor_id', $actor->id) !!}
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
                                <tr>
                                    <th colspan="2">Nome: {{ $actor->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <b>Info:</b> <br>
                                        {!! $actor->descriptionHtml() !!}
                                    </td>
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
