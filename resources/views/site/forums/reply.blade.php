@extends('layouts.dashboard')

@section('title', 'Reply')

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item"><a href="{{ url('forum') }}">Fórum</a></li>
                            <li class="breadcrumb-item">{{ link_to_route('forum.topics', $topic->forum->name, ['id' => $topic->forum->id, 'slug' => $topic->forum->slug]) }}</li>
                            <li class="breadcrumb-item"><a href="{{ route('forum.topic', [$topic->id, $topic->slug]) }}">{{ $topic->name }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reply</li>
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
                        <h4 class="card-title">Reply</h4>
                        @includeIf('errors.errors', [$errors])
                        {!! Form::open(['route' => ['reply', 'topicId' => $topic->id], 'class' => 'form-horizontal']) !!}
                        <div class="form-group">
                            {!! Form::label('content', 'Conteúdo: *', ['class' => 'form-label']) !!}
                            {!! Form::textarea('content', '[quote='.$post->post_username.' escreveu] '. $post->content . '[/quote]', ['class' => 'form-control', 'rows' => 10]) !!}
                        </div>
                        {!! Form::submit('Reply', ['class' => 'btn btn-danger btn-rounded']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            let textarea = document.getElementById('content');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
