@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}">Fórum</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('forum.topic', [$topic->id, $topic->slug]) }}">{{ $topic->name }}</a>
            </li>
            <li class="breadcrumb-item active">Editar Post</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <h6 class="card-header">Editar Post</h6>
        <div class="card-body">
            @includeIf('errors.errors', [$errors])
            <!-- Edit Post -->
            {!! Form::open(['route' => ['post.edit.form', 'id' => $topic->id, 'slug' => $topic->slug, 'postId' => $post->id], 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
            <div class="form-group">
                {!! Form::label('content', 'Conteúdo: *', ['class' => 'form-label']) !!}
                {!! Form::textarea('content', $post->content, ['class' => 'form-control', 'rows' => 10]) !!}
            </div>
            <br>
            {!! Form::submit('Editar Postagem', ['class' => 'btn btn-success btn-rounded btn-outline-success']) !!}
            {!! Form::close() !!}
            <!-- END Edit Post -->
        </div>
    </div>

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            var textarea = document.getElementById('content');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
