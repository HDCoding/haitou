@extends('layouts.dashboard')

@section('title', 'Remover Moderadores')

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
                            <li class="breadcrumb-item active" aria-current="page">Remover Moderadores</li>
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
                        <h4 class="card-title">Remover Moderadores</h4>
                        <p><b>Descrição: </b>{{ $forum->description }}</p>
                        <p>Remover membro como Moderador(a) neste fórum.</p>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::open(['route' => ['forum.editmod', 'id' => $forum->id], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            <div class="col-sm-10">
                                {!! Form::label('staff_id', 'Membro: *') !!}
                                {!! Form::select('staff_id[]', $members, $mod, ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::submit('Alterar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
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
