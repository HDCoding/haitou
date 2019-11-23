@extends('layouts.dashboard')

@section('subtitle', 'Fórum - Add Moderadores')

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
                <a href="{{ url('staff/forums') }}">Fórum: {{ $forum->name }}s</a>
            </li>
            <li class="breadcrumb-item active">Adicionar Moderadores</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Fórum: {{ $forum->name }}</h6>
        <div class="card-body">

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

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>
    <!-- Script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('.select2').select2({
            tags: true
        });
    </script>
@endsection
