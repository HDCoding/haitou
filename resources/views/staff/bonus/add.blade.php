@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Bônus')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/bonus') }}">@lang('dashboard.bonus')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Adicionar - Bônus</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::open(['url' => 'staff/bonus', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nome: *') !!}
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
                {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('description', 'Descrição:') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 8]) !!}
            </div>

            {!! Form::submit('Adicionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
            <br>
            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
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
