@extends('layouts.dashboard')

@section('title', 'Permissões membro')

@section('css')
    <!-- duallistbox -->
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/users') }}">@lang('dashboard.users')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Permissões membro</li>
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
                        <h4 class="card-title m-b-30">Permissões: {{ $user->username }}</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::open(['url' => 'staff/user/' . $user->id . '/updatepermission']) !!}
                        <div class="form-group">
                            {!! Form::select('allow_id[]', $permissions, $allowed, ['class' => 'duallistbox', 'multiple' => 'multiple', 'size' => '10']) !!}
                        </div>
                        <div class="text-center m-t-15">
                            <button type="submit" class="btn btn-primary m-r-10">Salvar alterações</button>
                            <button type="reset" class="btn btn-default">Cancelar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- duallistbox -->
    <script src="{{ asset('vendor/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
    <!-- Script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('.duallistbox').bootstrapDualListbox({
                moveOnSelect: true,
                selectorMinimalHeight: 350,
                filterPlaceHolder: 'Filtrar',
                moveAllLabel: 'Mover Tudo',
                removeSelectedLabel: 'Remover selecionado',
                removeAllLabel: 'Remover Tudo',
                infoText: 'Mostrando tudo {0}'
            });
        });
    </script>
@endsection
