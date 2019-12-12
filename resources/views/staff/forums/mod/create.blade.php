@extends('layouts.dashboard')

@section('title', 'Adicionar Moderadores')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/forums') }}">@lang('dashboard.forums')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar Moderadores</li>
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
                        <h4 class="card-title">Fórum: {{ $forum->name }}</h4>
                        <p><b>Descrição: </b>{{ $forum->description }}</p>

                        @includeIf('errors.errors', [$errors])
                        {!! Form::open(['route' => ['forum.addmod', 'id' => $forum->id]]) !!}
                        <div class="form-group">
                            {!! Form::label('user_id', 'Membro: *') !!}
                            {!! Form::select('user_id[]', $members, null, ['class' => 'duallistbox-custom-height', 'multiple' => 'multiple', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- Script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('.duallistbox-custom-height').bootstrapDualListbox({
                moveOnSelect: true,
                selectorMinimalHeight: 250
            });
        });
    </script>
@endsection
