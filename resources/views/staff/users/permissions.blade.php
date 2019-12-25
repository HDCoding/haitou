@extends('layouts.dashboard')

@section('title', 'Permissões membro')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/users') }}">@lang('dashboard.users')</a></li>
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
                        {!! Form::open(['url' => 'staff/user/' . $user->id . '/updatepermission']) !!}
                        @foreach($user->permissions as $permission)
                            <div class="custom-control custom-checkbox m-b-20">
{{--                                <input type="hidden" name="{{ $permission['key'] }}" value="{{ $permission['value'] == false ? 'false' : '' }}">--}}
{{--                                <input type="checkbox" class="custom-control-input" name="{{ $permission['key'] }}" id="{{ $permission['key'] }}" value="true" {{ $permission['value'] == true ? 'checked' : '' }}>--}}
{{--                                <label class="custom-control-label" for="{{ $permission['key'] }}">{{ $permission['title'] }}</label>--}}
                            </div>
                        @endforeach
                        <div class="text-center m-t-5">
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
