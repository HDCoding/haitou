@extends('layouts.dashboard')

@section('title', 'Tópico: ' . $topic->name)

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
                            <li class="breadcrumb-item active" aria-current="page">{{ $topic->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($topic->is_locked)
            <small><span class="badge badge-default align-text-bottom ml-1">Trancado</span></small>
        @endif
        @includeIf('errors.errors', [$errors])
        @if(auth()->user()->can('forum-mod'))
        <div class="row">
            <div class="col-md-12 mt-3 mb-4">
                <h4>Moderação</h4>
                <div class="float-left">
                    @if ($topic->is_locked)
                    <a href="{{ route('forum_openclose_topic', [$topic->id, $topic->slug])}}" class="btn btn-sm btn-success btn-rounded">
                        <i class="fa fa-lock-open"></i> Abrir Tópico
                    </a>
                    @else
                    <a href="{{ route('forum_openclose_topic', [$topic->id, $topic->slug])}}" class="btn btn-sm btn-primary btn-rounded">
                        <i class="ion ion-ios-lock"></i> Fechar Tópico
                    </a>
                    @endif

                    @if (!$topic->is_pinned)
                    <a href="{{ route('forum_pinunpin_topic', [$topic->id, $topic->slug]) }}" class="btn btn-sm btn-secondary btn-rounded">
                        <i class="fa fa-file"></i> Pin Tópico
                    </a>
                    @else
                    <a href="{{ route('forum_pinunpin_topic', [$topic->id, $topic->slug]) }}" class="btn btn-sm btn-danger btn-rounded">
                        <i class="fa fa-file"></i> Unpin Tópico
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @foreach($posts as $post)
            <div class="row">
                <div class="col-md-9 col-lg-9">
                    <div class="card">
                        <div class="card-header" id="post-{{ $post->id }}">
                            <a class="mr-3" href="{{ route('post.report', [$post->id]) }}" data-toggle="tooltip" title="Reportar Post">
                                <i class="fas fa-flag"></i>
                            </a>
                            @if($post->user_id == auth()->user()->id OR auth()->user()->can('forum-mod'))
                                <a href="{{ route('post.edit.form', ['id' => $topic->id, 'slug' => $topic->slug, 'postId' => $post->id]) }}" data-toggle="tooltip" title="Editar Post">
                                    <i class="fas fa-pencil-alt text-dark mr-3"></i>
                                </a>
                            @endif
                            @if(auth()->user()->can('forum-mod'))
                                <a href="javascript:;" onclick="document.getElementById('post-del-{{ $post->id }}').submit();" data-toggle="tooltip" title="Deletar Post">
                                    <i class="fas fa-trash-alt text-danger mr-3"></i>
                                </a>
                                {!! Form::open(['route' => ['post.delete', $post->id], 'method' => 'DELETE', 'id' => 'post-del-' . $post->id , 'style' => 'display: none']) !!}
                                {!! Form::close() !!}
                            @endif
                            <b class="float-right">{{ format_date_time($post->created_at) }}</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $post->contentHtml() !!}
                                <hr>

                                <div class="row col">
                                    <div class="col-lg-10">
                                        {!! $post->user->signature() !!}
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="ml-auto">
                                                <button class="btn btn-danger"><i class="fa fa fa-reply"></i> Reply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-md-3 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex no-block align-items-center">
                                <div class="m-r-10">
                                    <img class="img-fluid" src="{{ $post->user->avatar() }}" alt="{{ $post->post_username }}" width="50" />
                                </div>
                                <div class="float-left">
                                    <h5 class="m-b-0 font-16 font-medium">
                                        <a href="{{ route('user.profile', [$post->user->slug]) }}">{{ $post->post_username }}</a>
                                    </h5>
                                    <span>{{ $post->user->groupName() }}</span>
                                </div>
                            </div>
                            <hr>
                            <img class="img-fluid" src="{{ $post->user->mood->image() }}" title="{{ $post->user->mood->name() }}" alt="{{ $post->user->mood->name() }}">
                            <hr>
                            <p>{{ $post->user->title }}</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @if (auth()->user()->likes()->where('post_id', '=', $post->id)->where('is_like', '=', 1)->first())
                                <a class="text-success ml-3" href="{{ route('like.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Like Post">
                                    <i class="ion ion-ios-thumbs-up"></i> {{ $post->likis($post->id) }}
                                </a>
                            @else
                                <a class="text-dark ml-3" href="{{ route('like.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Like Post">
                                    <i class="ion ion-ios-thumbs-up"></i> {{ $post->likis($post->id) }}
                                </a>
                            @endif
                            @if (auth()->user()->likes()->where('post_id', '=', $post->id)->where('is_dislike', '=', 1)->first())
                                <a class="text-danger ml-3" href="{{ route('dislike.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Dislike Post">
                                    <i class="ion ion-ios-thumbs-down"></i> {{ $post->dislikes($post->id) }}
                                </a>
                            @else
                                <a class="text-dark ml-3" href="{{ route('dislike.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Dislike Post">
                                    <i class="ion ion-ios-thumbs-down"></i> {{ $post->dislikes($post->id) }}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}

    <div class="col-12">
        @if(!$topic->is_locked)
            <div class="card mb-4">
                <div class="card-header with-elements">
                    <span class="card-header-title mr-2">Resposta rápida:</span>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => route('forum.reply', ['id' => $topic->id, 'slug' => $topic->slug]), 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        {!! Form::label('content', 'Conteúdo: *', ['class' => 'form-label']) !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 8, 'required']) !!}
                    </div>
                    {!! Form::submit('Postar', ['class' => 'btn btn-primary btn-rounded']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        @else
            <p class="text-center mt-5 text-danger"><b>Tópico trancado para novas postagens.</b></p>
        @endif
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
            //text editor
            let textarea = document.getElementById('content');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css',
            });
        });
    </script>
@endsection
