@extends('layouts.dashboard')

@section('subtitle', 'Tópico: ' . $topic->name)

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
    <!-- atwho -->
    <link rel="stylesheet" href="{{ asset('vendor/atwho/css/jquery.atwho.min.css') }}">
@endsection

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3">
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}"><i class="ion ion-ios-chatbubbles"></i></a>
            </li>
            <li class="breadcrumb-item">
                {{ link_to_route('forum.topics', $topic->forum->name, ['id' => $topic->forum->id, 'slug' => $topic->forum->slug]) }}
            </li>
            <li class="breadcrumb-item active">
                {{ $topic->name }}
                @if($topic->is_locked)
                    <small><span class="badge badge-default align-text-bottom ml-1">Trancado</span></small>
                @endif
            </li>
        </ol>
    </div>

    @includeIf('errors.errors', [$errors])

    <div class="text-center mb-3">
        @if(auth()->user()->permission->forums_mod)
            <h3>Moderação</h3>
            @if ($topic->is_locked)
                <a href="{{ route('forum_openclose_topic', [$topic->id, $topic->slug])}}" class="btn btn-success">Abrir Tópico</a>
            @else
                <a href="{{ route('forum_openclose_topic', [$topic->id, $topic->slug])}}" class="btn btn-info">Fechar Tópoco</a>
            @endif

            @if (!$topic->is_pinned)
                <a href="{{ route('forum_pinunpin_topic', [$topic->id, $topic->slug]) }}" class="btn btn-primary">Pin Tópico</a>
            @else
                <a href="{{ route('forum_pinunpin_topic', [$topic->id, $topic->slug]) }}" class="btn btn-default">Unpin Tópico</a>
            @endif
        @endif
    </div>

    @foreach($posts as $post)
        @if($firstPost->id == $post->id)
            <div class="card mb-4">
                <div class="card-header">
                    <div class="media flex-wrap align-items-center">
                        <img src="{{ $post->user->getAvatar() }}" class="d-block ui-w-40 rounded-circle"
                             alt="Avatar">
                        <div class="media-body ml-3">
                            <a href="{{ route('user.profile', [$post->user->slug]) }}">{{ $post->user->name }}</a>
                            <div class="text-muted small">{{ $post->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <div class="text-muted small ml-3">
                            <div>
                                Membro desde <strong>{{ $post->user->created_at->format('d/m/Y') }}</strong>
                            </div>
                            <div>
                                <strong>{{ $post->user->forum_posts->count() - 1 }}</strong> posts
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $post->getContentHtml() !!}
                    <hr>
                    <p class="font-s13 text-muted">{{ $post->user->signature }}</p>
                    <div class="push-20">
                        <img class="img-avatar img-avatar32" src="{{ $post->user->mood->getImage() }}" title="{{ $post->user->mood->getName() }}" alt="Humor">
                    </div>
                </div>
                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                    <div class="px-4 pt-3">
                        <a href="javascript:void(0)" class="text-muted" data-toggle="tooltip"
                           title="Adicionar aos Favoritos">
                            <i class="ion ion-ios-heart-empty text-danger text-large align-middle"></i>&nbsp;
                            <span class="align-middle">0</span>
                        </a>
                        <span class="text-muted ml-4">
                    <i class="ion ion-ios-eye text-lighter text-large align-middle"></i>&nbsp;
                    <span class="align-middle">{{ $post->forum_topic->views }}</span>
                </span>
                        <a href="{{ route('post.report', ['id' => $post->id]) }}" class="text-muted ml-4" data-toggle="tooltip" title="Reportar Post">
                            <i class="fas fa-flag text-primary align-middle"></i>&nbsp;
                        </a>&nbsp;&nbsp;
                        @if($post->user_id == auth()->user()->id)
                            <a href="{{ route('post.edit.form', ['id' => $topic->id, 'slug' => $topic->slug, 'postId' => $post->id]) }}"
                               class="text-muted ml-4" data-toggle="tooltip" title="Editar Post">
                                <i class="fas fa-pencil-alt text-dark align-middle"></i>
                            </a>&nbsp;&nbsp;
                        @endif
                    </div>
                    <div class="px-4 pt-3">
                        <button type="button" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Reply
                        </button>
                    </div>
                </div>
            </div>
        @else
            <div class="card mb-3" id="post-{{ $post->id }}">
                <div class="card-body">
                    <div class="media">
                        <img src="{{ $post->user->getAvatar() }}" class="d-block ui-w-40 rounded-circle"
                             alt="Avatar">
                        <div class="media-body ml-4">
                            <div class="float-right text-muted small">
                                <a class="mr-3" href="#" data-toggle="tooltip" title="Reportar Post"><i class="fas fa-flag"></i></a>&nbsp;&nbsp;
                                @if($post->user_id == auth()->user()->id)
                                    <a href="{{ route('form.post.edit', ['id' => $topic->id, 'slug' => $topic->slug, 'postId' => $post->id]) }}"
                                       data-toggle="tooltip" title="Editar Post"><i
                                            class="fas fa-pencil-alt text-dark mr-3"></i></a>&nbsp;&nbsp;
                                @endif
                                @if($post->user_id == auth()->user()->id)
                                    <a href="javascript:;"
                                       onclick="document.getElementById('post-del-{{ $post->id }}').submit();"
                                       data-toggle="tooltip" title="Deletar Post"><i
                                            class="fas fa-trash-alt text-danger mr-3"></i></a>
                                    {!! Form::open(['route' => ['delete.post', 'id' => $post->id], 'method' => 'DELETE', 'id' => 'post-del-' . $post->id , 'style' => 'display: none']) !!}
                                    {!! Form::close() !!}
                                @endif
                                Postagem em: {{ $post->created_at->format('d/m/Y H:i') }}
                            </div>
                            <a href="{{ route('user.profile', [$post->user->slug]) }}">{{ $post->user->name }}</a>
                            <div class="text-muted small">Membro
                                desde {{ $post->user->created_at->format('d/m/Y') }}</div>
                            <div class="mt-2">
                                {!! $post->getContentHtml() !!}
                                <hr>
                                <p class="font-s13 text-muted">{{ $post->user->signature }}</p>
                                <div class="push-20">
                                    <img class="img-avatar img-avatar32" src="{{ $post->user->mood->getImage() }}"
                                         title="{{ $post->user->mood->getName() }}" alt="Humor">
                                </div>
                            </div>
                            <div class="small mt-2">
                                <a href="javascript:void(0)" class="text-light">Reply</a>
                                @if (auth()->user()->likes()->where('post_id', '=', $post->id)->where('is_like', '=', 1)->first())
                                    <a href="{{ route('like.post', [$post->id]) }}" class="text-success ml-3" data-toggle="tooltip" data-original-title="Like">
                                        <i class="ion ion-ios-thumbs-up"></i> {{ $post->likis($post->id) }}
                                    </a>
                                @else
                                    <a href="{{ route('like.post', [$post->id]) }}" class="text-light ml-3" data-toggle="tooltip" data-original-title="Like">
                                        <i class="ion ion-ios-thumbs-up"></i> {{ $post->likis($post->id) }}
                                    </a>
                                @endif
                                @if (auth()->user()->likes()->where('post_id', '=', $post->id)->where('is_dislike', '=', 1)->first())
                                    <a href="{{ route('dislike.post', [$post->id]) }}" class="text-danger ml-3" data-toggle="tooltip" data-original-title="Dislike">
                                        <i class="ion ion-ios-thumbs-down"></i> {{ $post->dislikes($post->id) }}
                                    </a>
                                @else
                                    <a href="{{ route('dislike.post', [$post->id]) }}" class="text-light ml-3" data-toggle="tooltip" data-original-title="Dislike">
                                        <i class="ion ion-ios-thumbs-down"></i> {{ $post->dislikes($post->id) }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    {{ $posts->links() }}

    @if(!$topic->is_locked)
        <div class="card mb-4">
            <div class="card-header with-elements">
                <span class="card-header-title mr-2">Postar</span>
            </div>
            <div class="card-body">
                {!! Form::open(['url' => route('forum.reply', ['id' => $topic->id, 'slug' => $topic->slug]), 'class' => 'form-horizontal']) !!}
                <div class="form-group">
                    {!! Form::label('content', 'Conteúdo: *', ['class' => 'form-label']) !!}
                    {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 8]) !!}
                </div>
                {!! Form::submit('Postar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
                <br>
                {!! Form::close() !!}
            </div>
        </div>
    @else
        <p class="text-center mt-5 text-danger"><b>Tópico trancado para novas postagens.</b></p>
    @endif

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //text editor
            var textarea = document.getElementById('content');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css',
            });
        });
    </script>
@endsection
