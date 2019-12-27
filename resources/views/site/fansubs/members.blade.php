@extends('layouts.dashboard')

@section('title', 'Adicionar Membro ao Fansub')

@section('css')
    <!-- select2 -->
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('fansubs') }}">Fansubs</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('fansub.show', [$fansub->id, $fansub->slug]) }}">{{ $fansub->name }}</a></li>
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
                        <h4 class="card-title">Adicionar Membro</h4>
                        <a href="#" data-toggle="modal" data-target="#modal-add-member">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nick</th>
                                    <th>Função</th>
                                    <th>Admin?</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <th>{{ $member->username }}</th>
                                        <td>{{ $member->job }}</td>
                                        <td>{{ $member->is_admin ? 'Sim' : 'Não' }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="javascript:;" onclick="document.getElementById('member-del-{{ $member->id }}').submit();" data-toggle="tooltip" title="Remover Membro"><i class="fa fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'fansub/' . $member->id .'/delmembers', 'method' => 'DELETE', 'id' => 'member-del-' . $member->id , 'style' => 'display: none']) !!}
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
                {!! Form::open(['route' => ['site.fansub.addmember', 'fansub_id' => $fansub->id], 'class' => 'modal-content form-horizontal']) !!}
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Membro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-row col-md-12">
                        <div class="form-group col-md-6">
                            <label class="form-label" for="user_id">Nick</label>
                            {!! Form::select('user_id', $users, null, ['class' => 'nickname form-control custom-select', 'style' => 'width: 100%; height:40px']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label class="form-label" for="job">Função</label>
                            {!! Form::text('job', null, ['class' => 'form-control', 'placeholder' => 'Ex: Encoder', 'maxlength' => 40]) !!}
                        </div>
                    </div>
                    @if($fansub->fansub_mod($fansub->id))
                    <div class="form-group col-md-12">
                        <label class="form-label" for="is_admin">Admin?</label>
                        <select class="form-control custom-select" name="is_admin" id="is_admin" data-style="form-control">
                            <option value="null" disabled selected>Admin?</option>
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    @endif
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

@section('scripts')
    <!-- Select2 -->
    <script src="{{ asset('vendor/select2/dist/js/select2.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            $(".nickname").select2({
                placeholder: 'Selecione',
                allowClear: true,
                dropdownParent: $("#modal-add-member")
            });
        });
    </script>
@endsection
