@extends('layouts.dashboard')

@section('subtitle', 'Editar Categoria')

@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/minicolors/minicolors.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/categories') }}">@lang('dashboard.categories')</a>
            </li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar - Categoria</h6>
        <div class="card-body">

            @includeIf('errors.errors', [$errors])
            {!! Form::model($category, ['url' => 'staff/categories/' . $category->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nome: *') !!}
                {!! Form::text('name', $category->name, ['class' => 'form-control', 'required']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('color', 'Cor: (Opcional)') !!}
                {!! Form::text('color', $category->color, ['class' => 'form-control', 'id' => 'minicolors']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('icon', 'Icone: (Opcional)') !!}
                {!! Form::text('icon', $category->icon, ['class' => 'form-control']) !!}
            </div>
            <br>
            {!! Form::submit('Alterar', ['class' => 'btn btn-success btn-rounded btn-outline-success']) !!}

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('script')
    <!-- Page JS Plugins -->
    <script src="{{ asset('vendor/minicolors/minicolors.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        let isRtl = $('body').attr('dir') === 'rtl' || $('html').attr('dir') === 'rtl';
        $('#minicolors').minicolors({
            control:  'saturation',
            position: 'bottom ' + (isRtl ? 'left' : 'right'),
        });
    </script>
@endsection
