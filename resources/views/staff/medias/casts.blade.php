@extends('layouts.dashboard')

@section('title', 'Casts')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/select2.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/medias') }}">@lang('dashboard.medias')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Casts</li>
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
                        <h4 class="card-title">Casts</h4>
                        <a href="#" data-toggle="modal" data-target="#modal-add-cast">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        @includeIf('errors.errors', [$errors])
                        <hr>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Atriz/Ator</th>
                                    <th>Personagem</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($casts as $cast)
                                    <tr>
                                        <td>{{ $cast->id }}</td>
                                        <td>{{ !empty($cast->actor->name) ? $cast->actor->name : '' }}</td>
                                        <td>{{ !empty($cast->character->name) ? $cast->character->name : '' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('cast-del-{{ $cast->id }}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover cast"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/media/cast/' . $cast->id .'/delete', 'method' => 'DELETE', 'id' => 'cast-del-' . $cast->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="modal-add-cast" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                {!! Form::open(['url' => 'staff/media/' . $media . '/casts', 'class' => 'modal-content form-horizontal']) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Cast</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="character_id">Personagem</label>
                            <select class="custom-select form-control select2" name="character_id" id="character_id" data-style="form-control">
                                <option value="0" disabled selected>Personagem</option>
                                @foreach($characters as $character)
                                    <option value="{{ $character->id }}">{{ $character->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="actor_id">Atriz/Ator</label>
                            <select class="custom-select form-control select2" name="actor_id" id="actor_id" data-style="form-control">
                                <option value="0" disabled selected>Atriz/Ator</option>
                                @foreach($actors as $actor)
                                    <option value="{{ $actor->id }}">{{ $actor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                    {!! Form::submit('Adicionar', ['class' => 'btn btn-rounded btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Add Modal -->
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $(".select2").select2({
                dropdownParent: $("#modal-add-cast")
            });
        });
    </script>
@endsection
