@extends('layouts.dashboard')

@section('title', 'Adicionar Moderadores')

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
                        {!! Form::open(['route' => ['forum.addmod', 'id' => $forum->id], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-sm-10">
                                {!! Form::label('staff_id', 'Membro: *') !!}
                                {!! Form::select('staff_id[]', $members, null, ['class' => 'form-control select2 input-lg', 'multiple' => 'multiple', 'required']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                            </div>
                        </div>
                        <br>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>
    <!-- Script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('.select2').select2({
            tags: true
        });
    </script>
@endsection
