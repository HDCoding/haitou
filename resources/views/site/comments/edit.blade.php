@extends('layouts.dashboard')

@section('title', 'Editar comentário')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Editar comentário</li>
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
                        <h4 class="card-title">Editar comentário</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::model($comment, ['url' => 'comments/' . $comment->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('content', 'Comentário: *') !!}
                            {!! Form::textarea('content', $comment->content, ['class' => 'form-control', 'rows' => '5']) !!}
                        </div>

                        @if(!empty($comment->torrent_id) OR !empty($comment->media_id))
                            <div class="form-group">
                                <label class="custom-control custom-checkbox">
                                    {!! Form::checkbox('is_spoiler', true, $comment->is_spoiler, ['class' => 'custom-control-input']) !!}
                                    <i class="custom-control-label">Spoiler?</i>
                                </label>
                            </div>
                        @endif

                        {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
