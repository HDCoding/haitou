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
                            <li class="breadcrumb-item"><a href="{{ url('staff/permissions') }}">@lang('dashboard.permissions')</a></li>
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
            <div class="col-lg-12 col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex no-block align-items-center m-b-30">
                            <h3 class="card-title text-info">{{ $permission->name }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable" class="table table-bordered nowrap display">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Nick</th>
                                    <th>Grupo</th>
                                    <th>Status</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><img class="img-rounded" src="{{ $user->user->avatar() }}" alt="Avatar" width="70px"></td>
                                        <td class="align-middle">{{ $user->user->username }}</td>
                                        <td class="align-middle">{{ $user->user->groupName() }}</td>
                                        <td class="align-middle">{!! $user->user->status() !!}</td>
                                        <td>
                                            @if(auth()->user()->id !== $user->user->id)
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Opções
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item" href="{{ url('staff/users/' . $user->user->id . '/edit') }}">
                                                            <i class="fas fa-pencil-alt text-info m-r-10"></i> Editar Usuário
                                                        </a>
                                                        @if(auth()->user()->can('permissoes-mod'))
                                                            <a class="dropdown-item" href="{{ url('staff/user/' . $user->user->id . '/permissions') }}">
                                                                <i class="fas fa-key text-success m-r-10"></i> Editar Permissões
                                                            </a>
                                                        @endif
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
                    "url": '{{ asset('vendor/datatables/Portuguese-Brasil.json') }}'
                }
            });
        });
    </script>
@endsection
