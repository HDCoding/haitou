@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.genres'))

@section('css')
    @include('includes.datatables.css')
    <!-- X-Editable -->
    <link href="{{ asset('vendor/x-editable/dist/css/bootstrap-editable.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">@lang('dashboard.genres')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <div class="card-header with-elements">
            <div class="card-header-elements">
                <a href="#" data-toggle="modal" data-target="#modal-add">
                    <button type="button" class="btn btn-xs btn-outline-primary">
                        <span class="ion ion-md-add"></span> Adicionar
                    </button>
                </a>
            </div>
        </div>
        @includeIf('errors.errors', [$errors])
        <div class="card-datatable table-responsive">
            <table class="table table-bordered table-striped data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Uso em mídias</th>
                        <th class="text-center">Opções</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($genres as $genre)
                    <tr>
                        <td>{{ $genre->id }}</td>
                        <td>
                            <a href="#" class="genreEdit" id="name" data-type="text" data-column="name" data-title="Editar Gênero" data-name="name" data-value="{{ $genre->name }}" data-pk="{{ $genre->id }}" data-url="{{ route('genres.update', ['id' => $genre->id]) }}">{{ $genre->name }}</a>
                        </td>
                        <td>
                            <span class="badge badge-success">{{ $genre->media->count() }}</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <a href="javascript:" onclick="document.getElementById('genre-del-{{$genre->id}}').submit();" class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Gênero"><i class="fa fa-times text-danger"></i></a>
                                {!! Form::open(['url' => 'staff/genres/' . $genre->id, 'method' => 'DELETE', 'id' => 'genre-del-' . $genre->id, 'style' => 'display: none']) !!}
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
    <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            {!! Form::open(['url' => 'staff/genres', 'class' => 'modal-content form-horizontal']) !!}
            <div class="modal-header">
                <h5 class="modal-title">Gênero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('name', 'Gênero:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome', 'required', 'maxlength' => 25]) !!}
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
    @include('includes.datatables.js', ['perPage' => 50, 'order' => false])
    <!-- X-Editable -->
    <script src="{{ asset('vendor/x-editable/dist/js/bootstrap-editable.min.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready( function () {
            //update genre
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.genreEdit').editable({
                mode: 'inline',
                type: 'string',
                min: 1,
                max: 45,
                ajaxOptions: {
                    type: 'put',
                    dataType: 'json'
                },
                validate:function(string){
                    if ($.trim(string) === '') {
                        return "Campo é obrigatório.";
                    }
                    let texto = $.trim(string.length);
                    if (texto <= 0 || texto >= 46) {
                        return "Minimo 1 e Máximo de 45 caracteres.";
                    }
                },
                success:function(data){
                    console.log(data);
                } ,
                error:function(data) {
                    console.log(data);
                }
            });
        });
    </script>
@endsection
