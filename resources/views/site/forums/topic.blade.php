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
                            <li class="breadcrumb-item">{{ link_to_route('forum.threads', $topic->forum->name, ['forum_id' => $topic->forum->id, 'slug' => $topic->forum->slug]) }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $topic->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @if($topic->is_locked)
            <span class="badge badge-default small align-text-bottom ml-1">Trancado</span>
        @endif
        @includeIf('errors.errors', [$errors])
        @include('includes.messages')

        <div class="row">
            <div class="col-md-12 mt-3 mb-4">
                @if(auth()->user()->can('forum-mod'))
                    <h4>Moderação</h4>
                @endif
                <div class="float-left">
                    @if(auth()->user()->can('forum-mod'))
                        @if ($topic->is_locked)
                        <a href="{{ route('topic.open', ['topic_id' => $topic->id])}}" class="btn btn-sm btn-success btn-rounded">
                            <i class="fas fa-lock-open"></i> Abrir Tópico
                        </a>
                        @else
                        <a href="{{ route('topic.close', ['topic_id' => $topic->id])}}" class="btn btn-sm btn-primary btn-rounded">
                            <i class="ion ion-ios-lock"></i> Fechar Tópico
                        </a>
                        @endif

                        @if (!$topic->is_pinned)
                        <a href="{{ route('topic.pin', ['topic_id' => $topic->id]) }}" class="btn btn-sm btn-secondary btn-rounded">
                            <i class="fas fa-file"></i> Pin Tópico
                        </a>
                        @else
                        <a href="{{ route('topic.unpin', ['topic_id' => $topic->id]) }}" class="btn btn-sm btn-danger btn-rounded">
                            <i class="fas fa-file"></i> Unpin Tópico
                        </a>
                        @endif
                    @endif
                    @if(auth()->user()->id == $topic->first_post_user_id OR auth()->user()->can('forum-mod'))
                        <a href="{{ route('topic.form.edit', ['topic_id' => $topic->id]) }}" class="btn btn-sm btn-dark btn-rounded">
                            <i class="fas fa-pencil-alt"></i> Editar Tópico
                        </a>
                    @endif
                </div>
                <div class="float-right">
                    @if (auth()->user()->isSubscribed($topic->id))
                        <a href="{{ route('unsubscribe.topic', ['topic_id' => $topic->id]) }}" class="btn btn-sm btn-danger btn-rounded">
                            <i class="fas fa-bell-slash"></i> Cancelar Inscrição
                        </a>
                    @else
                        <a href="{{ route('subscribe.topic', ['topic_id' => $topic->id]) }}" class="btn btn-sm btn-success btn-rounded">
                            <i class="fas fa-bell"></i> Se Inscrever
                        </a>
                    @endif
                </div>
            </div>
        </div>
        @if(auth()->user()->id == $topic->first_post_user_id || auth()->user()->can('forum-mod'))
        <div class="row">
            <div class="col-md-12 mt-3 mb-4">
                <h4>Polls</h4>
                <div class="float-left">
                    @if(!empty($topic->poll_id))
                        <a href="{{ url('staff/poll/' . $topic->id . '/options/add') }}" data-toggle="tooltip" title="Adicionar Opções"><i class="fa fa-plus text-warning"></i></a>
                        <a class="m-l-15" href="{{ url('staff/poll/' . $topic->id . '/options/remove') }}" data-toggle="tooltip" title="Remover Opções"><i class="fa fa-minus text-success"></i></a>
                        <a class="m-l-15" href="{{ route('topic.poll.edit', ['topic_id' => $topic->id]) }}" data-toggle="tooltip" title="Editar Poll"><i class="fa fa-pencil-alt text-info"></i></a>
                        <a class="m-l-15" href="javascript:;" onclick="document.getElementById('poll-del-{{ $topic->id }}').submit();" data-toggle="tooltip" title="Remover Poll"><i class="fa fa-times text-danger"></i></a>
                        {!! Form::open(['url' => 'topic/polls/' . $topic->id, 'method' => 'DELETE', 'id' => 'poll-del-' . $topic->id, 'style' => 'display: none']) !!}
                        {!! Form::close() !!}
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
                                <a href="{{ route('post.edit.form', ['topic_id' => $topic->id, 'post_id' => $post->id]) }}" data-toggle="tooltip" title="Editar Post">
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
                            @if (auth()->user()->likes()->where('post_id', '=', $post->id)->first())
                                <a href="{{ route('like.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Like Post">
                                    <i class="fas fa-thumbs-up text-info"></i>
                                </a>
                                ({{ $post->likesCount($post->id) }})
                            @else
                                <a href="{{ route('like.post', [$post->id]) }}" data-toggle="tooltip" data-original-title="Like Post">
                                    <i class="fas fa-thumbs-up text-dark"></i>
                                </a>
                                ({{ $post->likesCount($post->id) }})
                            @endif
                            <b class="float-right">{{ format_date_time($post->created_at) }}</b>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                {!! $post->contentHtml() !!}
                                <hr>
                                <div class="row col">
                                    @if(auth()->user()->show_forum_signatures)
                                    <div class="col-lg-10">
                                        {!! $post->user->signature() !!}
                                    </div>
                                    @endif
                                    <div class="col-lg-2">
                                        <div class="d-flex no-block align-items-center">
                                            <div class="ml-auto">
                                                @if(!$topic->is_locked && $post->user_id !== auth()->user()->id)
                                                <a href="{{ route('post.reply', ['topic_id' => $topic->id, 'post_id' => $post->id]) }}">
                                                    <button class="btn btn-danger"><i class="fas fa-reply"></i> Reply</button>
                                                </a>
                                                @endif
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
                </div>
            </div>
        @endforeach
    </div>

    {{ $posts->links() }}

    <div class="col-12">
        @if(!$topic->is_locked || auth()->user()->can('forum-mod'))
            <div class="card mb-4">
                <div class="card-header with-elements">
                    <span class="card-header-title mr-2">Resposta rápida:</span>
                </div>
                <div class="card-body">
                    {!! Form::open(['url' => route('forum.post', ['topic_id' => $topic->id]), 'class' => 'form-horizontal']) !!}
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
