@extends('layouts.dashboard')

@section('title', trans('dashboard.users'))

@section('css')
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.users')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Column -->
            <div class="col-lg-8 col-xl-9 col-md-9">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center m-b-30">
                            <h4 class="card-title">@lang('dashboard.users')</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered nowrap display">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Nick</th>
                                    <th>Grupo</th>
                                    <th>Status</th>
                                    <th>Suspensões</th>
                                    <th>Advertências</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><img class="img-rounded" src="{{ $user->avatar() }}" alt="Avatar" width="70px"></td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->groupName() }}</td>
                                        <td>{!! $user->status() !!}</td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            @if(auth()->user()->id !== $user->id)
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Opções
                                                </button>
                                                <div class="dropdown-menu">
                                                    @if($user->status != 4)
                                                        <a class="dropdown-item" href="{{ url('staff/user/' . $user->id . '/ban') }}">
                                                            <i class="fa fa-ban text-danger m-r-10"></i> Banir Usuário
                                                        </a>
                                                    @endif
                                                    @if($user->status != 3)
                                                        <a class="dropdown-item" href="{{ url('staff/user/' . $user->id . '/suspend') }}">
                                                            <i class="fa fa-pause text-success m-r-10"></i> Suspender Usuário
                                                        </a>
                                                    @endif
                                                    @if($user->status != 3 || $user->status != 4)
                                                        <a class="dropdown-item" href="{{ url('staff/user/' . $user->id . '/warn') }}">
                                                            <i class="fas fa-hand-point-right text-warning m-r-10"></i> Advertir Usuário
                                                        </a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ url('staff/users/' . $user->id . '/edit') }}">
                                                        <i class="fas fa-pencil-alt text-info m-r-10"></i> Editar Usuário
                                                    </a>
                                                    @if(auth()->user()->can('permissoes-mod'))
                                                    <a class="dropdown-item" href="{{ url('staff/user/' . $user->id . '/permissions') }}">
                                                        <i class="fas fa-key text-success m-r-10"></i> Editar Permissões
                                                    </a>
                                                    @endif
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{ url('staff/user/' . $user->id . '/notes') }}">
                                                        <i class="fas fa-book text-info m-r-10"></i> Anotações
                                                    </a>
                                                </div>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-4 col-xl-3 col-md-3">
                <div class="card">
                    <div class="border-bottom p-15">
                        <b>Pesquisar</b>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'staff/user/search']) !!}
                            <div class="col-md m-b-4">
                                <label class="form-label" for="group">Grupo</label>
                                <select class="custom-select" name="group" id="group">
                                    <option value="null" disabled selected>Grupo</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md m-b-4 m-t-10">
                                <label class="form-label" for="status">Status da conta</label>
                                <select class="custom-select" name="status" id="status" data-style="form-control">
                                    <option value="" disabled selected>Status</option>
                                    <option value="1">Pendente</option>
                                    <option value="2">Confirmada</option>
                                    <option value="3">Suspensa</option>
                                    <option value="4">Banida</option>
                                </select>
                            </div>
                            <div class="col-md m-b-4 m-t-10">
                                <div class="input-group-append">
                                    <button class="btn btn-info">Pesquisar</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                        <h4 class="card-title m-t-30">Contas</h4>
                        <div class="list-group">
                            <p class="list-group-item">
                                <span class="badge badge-success m-r-10">
                                    <i class="fa fa-user-check"></i>
                                </span>
                                Ativadas
                                <span class="float-right">{{ $activated }}</span>
                            </p>
                            <a class="list-group-item">
                                <span class="badge badge-danger m-r-10">
                                    <i class="fa fa-user-alt-slash"></i>
                                </span>
                                Banidas
                                <span class="float-right">{{ $banned }}</span>
                            </a>
                            <a class="list-group-item">
                                <span class="badge badge-info m-r-10">
                                    <i class="fa fa-user-clock"></i>
                                </span>
                                Pendentes
                                <span class="float-right">{{ $pendent }}</span>
                            </a>
                            <a class="list-group-item">
                                <span class="badge badge-warning m-r-10">
                                    <i class="fa fa-user-lock"></i>
                                </span>
                                Suspensas
                                <span class="float-right">{{ $suspended }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
