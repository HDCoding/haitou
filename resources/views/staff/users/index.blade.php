@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.users'))

@section('css')
    @include('includes.datatables.css')
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.users')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <!-- Filters -->
    <div class="ui-bordered px-4 pt-4 mb-4">
        {!! Form::open(['url' => 'staff/user/search']) !!}
        <div class="form-row align-items-center">
            <div class="col-md mb-4">
                <label class="form-label" for="group_id">Grupo</label>
                <select class="custom-select" name="group_id" id="group_id" data-style="form-control">
                    <option value="null" disabled selected>Grupo</option>
                    @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md mb-4">
                <label class="form-label" for="status">Status da conta</label>
                <select class="custom-select" name="status" id="status" data-style="form-control">
                    <option value="null" disabled selected>Status</option>
                    <option value="0">Pendente</option>
                    <option value="1">Confirmada</option>
                    <option value="2">Suspensa</option>
                    <option value="3">Banida</option>
                </select>
            </div>
            <div class="col-md col-xl-2 mb-4">
                <label class="form-label d-none d-md-block">&nbsp;</label>
                <button type="submit" class="btn btn-secondary btn-block">Mostrar</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- / Filters -->

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="table table-striped table-bordered data-table">
                <thead>
                    <tr>
                        <th class="text-center"><i class="fas fa-user"></i></th>
                        <th class="text-center">Nome</th>
                        <th class="text-center">Classe</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Suspensões</th>
                        <th class="text-center">Advertências</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="text-center">
                            <img class="" src="{{ $user->avatar() }}" alt="Avatar" width="70px">
                        </td>
                        <td class="text-center">{{ $user->username }}</td>
                        <td class="text-center">{{ $user->group->name }}</td>
                        <td class="text-center">
                            {!! $user->status() !!}
                        </td>
                        <td class="text-center"></td>
                        <td class="text-center"></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button class="btn btn-default" type="button">Opções</button>
                                <div class="btn-group">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-header">Conta</li>
                                        @if($user->status != 3)
                                            <li>
                                                <a tabindex="-1" href="{{ url('staff/user/' . $user->id . '/ban') }}"><i class="fa fa-ban text-danger"></i> Banir Usuário</a>
                                            </li>
                                        @endif
                                        @if($user->status != 2)
                                            <li>
                                                <a tabindex="-1" href="{{ url('staff/user/' . $user->id . '/suspend') }}"><i class="fa fa-pause text-success"></i> Suspender Usuário</a>
                                            </li>
                                        @endif
                                        @if($user->status != 2 || $user->status != 3)
                                        <li>
                                            <a tabindex="-1" href="{{ url('staff/user/' . $user->id . '/warn') }}"><i class="fas fa-hand-point-right text-warning"></i> Advertir Usuário</a>
                                        </li>
                                        @endif
                                        <li class="dropdown-header">Staff</li>
                                        <li>
                                            <a tabindex="-1" href="{{ url('staff/users/' . $user->id . '/edit') }}"><i class="fas fa-pencil-alt text-info"></i> Editar Usuário</a>
                                        </li>
                                        <li>
                                            <a tabindex="-1" href="{{ url('staff/user/' . $user->id . '/permissions') }}"><i class="fas fa-key text-success"></i> Editar Permissões</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">Nota</li>
                                        <li>
                                            <a tabindex="-1" href="{{ url('staff/user/' . $user->id . '/notes') }}"><i class="fas fa-book text-info"></i> Anotações</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li class="dropdown-header">ADM</li>
                                        <li>
                                            {{--<a href="javascript:;" onclick="document.getElementById('user-del-{{ $user->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Usuário"><i class="fa fa-times text-danger"></i></a>--}}
                                            {{--{!! Form::open(['url' => 'staff/users/' . $user->id, 'method' => 'DELETE', 'id' => 'user-del-' . $user->id , 'style' => 'display: none']) !!}--}}
                                            {{--{!! Form::close() !!}--}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('script')
    @include('includes.datatables.js', ['perPage' => 50, 'order' => false])
@endsection
