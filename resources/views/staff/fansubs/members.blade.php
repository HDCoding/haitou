@extends('layouts.dashboard')

@section('subtitle', 'Adicionar Membros ao Fansub')

@section('css')
    <!-- select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/fansubs') }}">@lang('dashboard.fansubs')</a>
            </li>
            <li class="breadcrumb-item active">Adicionar Membros ao Fansub</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="#" data-toggle="modal" data-target="#modal-add-member">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        <div class="card-body">
            <table class="table card-table">
                <thead class="thead-light">
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
                                <a href="javascript:;" onclick="document.getElementById('member-del-{{ $member->id }}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Membro"><i class="fa fa-times text-danger"></i></a>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                {!! Form::submit('Adicionar', ['class' => 'btn btn-rounded btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <!-- END Add Modal -->

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
