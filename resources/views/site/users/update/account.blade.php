@extends('layouts.dashboard')

@section('title', 'Editar Conta')

@section('css')
    <!-- DateTimePicker -->
    <link href="{{ asset('vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"/>
    <!-- Vegas -->
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar Conta</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card vegas-fixed-background" id="user-cover">
                    <div class="card-body py-home">
                        {!! Form::open(['route' => 'post.cover', 'files' => true, 'class' => 'form-horizontal', 'id' => 'form-cover']) !!}
                        <h2 class="text-center text-primary">
                            <button class="btn btn-outline-light waves-effect waves-light" type="button" onclick="chooseCover()">
                                <span class="btn-label"><i class="fa fa-pencil-alt"></i></span>
                            </button>
                        </h2>
                        <input type="file" id="coverInput" name="cover" class="form-control" accept="image/*" style="display: none"/>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        @include('site.users.update.card')
        <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    @include('site.users.update.links')
                    <div class="tab-content">
                        <div class="card-body">
                            <h4 class="card-title">Editar Conta</h4>
                            @includeIf('errors.errors', [$errors])
                            {!! Form::open(['route' => 'post.profile', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                {!! Form::label('state_id', 'Estado:', ['class' => 'form-label']) !!}
                                {!! Form::select('state_id', $states, auth()->user()->state_id, ['class' => 'custom-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('mood_id', 'Humor:', ['class' => 'form-label']) !!}
                                {!! Form::select('mood_id', $moods, auth()->user()->mood_id, ['class' => 'custom-select']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('birthday', 'Nascimento:', ['class' => 'form-label']) !!}
                                {!! Form::text('birthday', auth()->user()->birthday->format('Y-m-d'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('info', 'Info:', ['class' => 'form-label']) !!}
                                {!! Form::textarea('info', auth()->user()->info, ['class' => 'form-control', 'rows' => 3]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('signature', 'Assinatura (Fórum):', ['class' => 'form-label']) !!}
                                {!! Form::textarea('signature', auth()->user()->signature, ['class' => 'form-control', 'rows' => 8]) !!}
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded">Salvar alterações</button>&nbsp;
                            <button type="button" class="btn btn-default btn-rounded">Cancelar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- DateTimePicker -->
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-datepicker/dist/locales/bootstrap-datepicker.pt-BR.min.js') }}"></script>
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        <!-- datepicker -->
        $(document).ready(function () {
            $('#birthday').datepicker({
                format: 'yyyy-mm-dd',
                language: 'pt-BR',
                autoclose: true
            });
        });
        $(function() {
            // Fixed bg
            $('#user-cover').vegas({
                overlay: false,
                timer: false,
                shuffle: true,
                slides: [
                    { src: "{{ auth()->user()->cover() }}" },
                ],
                transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
            });
        });
    </script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        function chooseAvatar() {
            $("#avatarInput").click();
        }
        function chooseCover() {
            $("#coverInput").click();
        }
        $(document).ready(function () {
            $('#avatarInput').on('change', function () {
                $('#form-avatar').submit();
            });
            $('#coverInput').on('change', function () {
                $('#form-cover').submit();
            });
        });
    </script>

@endsection
