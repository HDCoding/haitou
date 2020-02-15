@extends('layouts.dashboard')

@section('title', 'Mídias Imagens')

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
                            <li class="breadcrumb-item active" aria-current="page">Mídias Imagens</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row col-5">
            <h4 class="mt-3 mb-3 text-info text-danger">{{ $media->name }}</h4>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Cover
                            <button type="button" class="btn btn-xs btn-primary" onclick="chooseCover()">
                                <span class="ion ion-md-add"></span> Cover
                            </button>
                        </h4>

                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <br>
                        <img src="{{ $media->cover() }}" class="img-fluid mx-auto d-block mt-2" alt="Cover" />
                        {!! Form::open(['route' => ['staff.media.cover', $media->id], 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-cover']) !!}
                        <input type="file" id="coverInput" name="cover" class="form-control" accept="image/*" style="display: none">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Poster
                            <button type="button" class="btn btn-xs btn-primary" onclick="choosePoster()">
                                <span class="ion ion-md-add"></span> Poster
                            </button>
                        </h4>

                        <img src="{{ $media->poster() }}" class="img-fluid mx-auto d-block mt-4" alt="Poster"/>
                        {!! Form::open(['route' => ['staff.media.poster', $media->id], 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-poster']) !!}
                        <input type="file" id="posterInput" name="poster" class="form-control" accept="image/*" style="display: none">
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('scripts')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        function choosePoster() {
            $("#posterInput").click();
        }
        function chooseCover() {
            $("#coverInput").click();
        }

        $(document).ready(function () {
            $('#posterInput').on('change', function () {
                $('#form-poster').submit();
            });
            $('#coverInput').on('change', function () {
                $('#form-cover').submit();
            });
        });
    </script>
@endsection
