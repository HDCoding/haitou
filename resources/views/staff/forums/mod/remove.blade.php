@extends('layouts.dashboard')

@section('title', 'Remover Moderadores')

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
                                {!! Form::label('user_id', 'Membro: *') !!}
                                {!! Form::select('user_id[]', $members, $mod, ['class' => 'duallistbox-custom-height', 'multiple' => 'multiple']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                {!! Form::submit('Alterar', ['class' => 'btn btn-primary btn-rounded']) !!}
                            </div>
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
            $('.duallistbox-custom-height').bootstrapDualListbox({
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
