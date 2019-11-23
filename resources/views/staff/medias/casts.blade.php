@extends('layouts.dashboard')

@section('subtitle', 'Casts Mídia')

@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/medias') }}">@lang('dashboard.medias')</a>
            </li>
            <li class="breadcrumb-item active">Casts</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="#" data-toggle="modal" data-target="#modal-add-cast">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        @includeIf('errors.errors', [$errors])
        <table class="table card-table">
            <thead class="thead-light">
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
                            <a href="javascript:;" onclick="document.getElementById('cast-del-{{ $cast->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover cast"><i class="fa fa-times text-danger"></i></a>
                            {!! Form::open(['url' => 'staff/media/cast/' . $cast->id .'/delete', 'method' => 'DELETE', 'id' => 'cast-del-' . $cast->id , 'style' => 'display: none']) !!}
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                {!! Form::submit('Adicionar', ['class' => 'btn btn-rounded btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END Add Modal -->

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //Select2
            $(".select2").select2({
                dropdownParent: $("#modal-add-cast")
            });
        });
    </script>
@endsection
