@extends('layouts.dashboard')

@section('title', 'Adicionar Membro ao Fansub')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/select2.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/fansubs') }}">@lang('dashboard.fansubs')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Adicionar Membro</li>
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
                        <h4 class="card-title">Conquistas</h4>
                        <div class="table-responsive m-t-40">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nick</th>
                                    <th>Função</th>
                                    <th>Admin?</th>
                                    <th class="text-center">Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fansub_members as $member)
                                    <tr>
                                        <td>{{ $member->user->name }}</td>
                                        <td>{{ $member->job }}</td>
                                        <td>{{ $member->is_admin ? 'Sim' : 'Não' }}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('member-del-{{ $member->id }}').submit();" class="btn btn-xs" type="button" data-toggle="tooltip" title="Remover Membro"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/fansub/' . $member->id .'/delmembers', 'method' => 'DELETE', 'id' => 'member-del-' . $member->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Modal -->
        <div class="modal fade" id="modal-add-member" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                {!! Form::open(['url' => 'staff/fansub/addmembers', 'class' => 'modal-content form-horizontal']) !!}
                {!! Form::hidden('fansub_id', $fansub->id) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Membro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_id">Nick</label>
                            {!! Form::select('user_id', $users, null, ['class' => 'custom-select form-control nickname']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="job">Função</label>
                            {!! Form::text('job', null, ['class' => 'form-control', 'placeholder' => 'Ex: Encoder', 'maxlength' => 40]) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="is_admin">Admin?</label>
                            <select class="custom-select form-control" name="is_admin" id="is_admin" data-style="form-control">
                                <option value="null" disabled selected>Membro é Admin?</option>
                                <option value="1">Sim</option>
                                <option value="0">Não</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn" data-dismiss="modal">Fechar</button>
                    {!! Form::submit('Adicionar', ['class' => 'btn btn-rounded btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <!-- END Add Modal -->
    </div>

@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/select2.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".nickname").select2({
                dropdownParent: $("#modal-add-member")
            });
        });
    </script>
@endsection
