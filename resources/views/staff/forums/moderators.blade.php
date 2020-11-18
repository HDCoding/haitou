@extends('layouts.dashboard')

@section('title', 'Moderadores')

@section('css')
    <!-- select2 -->
    <link href="{{ secure_asset('vendor/bootstrap-duallistbox/dist/bootstrap-duallistbox.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">Moderadores</li>
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
                        <p>Adicionar/Remover membros como Moderador(a)s neste fórum.</p>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        {!! Form::open(['url' => 'staff/forum/' . $forum->id . '/moderators']) !!}
                        <div class="form-group">
                            {!! Form::label('user_id', 'Membro: *') !!}
                            {!! Form::select('user_id[]', $members, $member, ['class' => 'duallistbox-custom-height', 'multiple' => 'multiple', 'size' => '10']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Atualizar', ['class' => 'btn btn-primary btn-rounded']) !!}
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
    <script src="{{ secure_asset('vendor/bootstrap-duallistbox/dist/jquery.bootstrap-duallistbox.min.js') }}"></script>
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
