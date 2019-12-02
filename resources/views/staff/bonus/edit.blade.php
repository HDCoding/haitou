@extends('layouts.dashboard')

@section('title', 'Editar')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/bonus') }}">@lang('dashboard.bonus')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar</li>
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
                        <h4 class="card-title">Editar</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($bon, ['url' => 'staff/bonus/' . $bon->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Nome:') !!}
                            {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('cost', 'Pontos:') !!}
                            {!! Form::text('cost', null, ['class' => 'form-control']) !!}
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('bonus_type', 'Tipo:') !!}
                                    {!! Form::select('bonus_type', [
                                        0 => 'Download',
                                        1 => 'Upload',
                                        2 => 'Freeleech - Dias',
                                        3 => 'Advertência',
                                        4 => 'Convite',
                                        5 => 'Slots'
                                    ], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-5" id="bits">
                                <div class="form-group">
                                    {!! Form::label('bytes', 'Byte:') !!}
                                    {!! Form::select('bytes', [null => 'Selecione um valor', 0 => 'MB', 1 => 'GB', 2 => 'TB'], null, ['class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('quantity', 'Quantidade:') !!}
                            {!! Form::text('quantity', $bon->getValue(), ['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('description', 'Descrição:') !!}
                            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
                        </div>

                        {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                        <br>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $("#bonus_type").bind("change", function () {
                if ($(this).val() == 'gift') {
                    $("#bits").hide();
                } else if ($(this).val() == 'freeleech') {
                    $("#bits").hide();
                } else if ($(this).val() == 'warning') {
                    $("#bits").hide();
                } else if ($(this).val() == 'invite') {
                    $("#bits").hide();
                } else if ($(this).val() == 'slots') {
                    $("#bits").hide();
                } else if ($(this).val() == 'download') {
                    $("#bits").show();
                } else if ($(this).val() == 'upload') {
                    $("#bits").show();
                }
            });
        });
    </script>
@endsection
