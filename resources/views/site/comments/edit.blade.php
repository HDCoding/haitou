@extends('layouts.dashboard')

@section('subtitle', 'Editar Comentário')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item active">Editar comentário</li>
        </ol>
    </div>

    <div class="card mb-4">
        <h6 class="card-header">Comentário - Editar comentário</h6>
        <div class="card-body">

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
                    <span class="custom-control-label">Spoiler?</span>
                </label>
            </div>
            @endif

            {!! Form::submit('Editar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
            <br>
            {!! Form::close() !!}

        </div>
    </div>

@endsection
