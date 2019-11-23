@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3">
            <li class="breadcrumb-item active">
                <i class="ion ion-ios-chatbubbles"></i>
                &nbsp; Fórum
            </li>
        </ol>
        <div class="col-12 col-md-3 p-0 mb-3">
            {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
            {!! Form::hidden('sorting', 'created_at') !!}
            {!! Form::hidden('direction', 'desc') !!}
            {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisar...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @includeIf('errors.errors', [$errors])

    @if(setting()->forum_on)

        @include('site.forums.buttons')

        @foreach($categories as $category)
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row no-gutters align-items-center">
                        <div class="col font-weight-bold">{{ $category->name }}</div>
                        <div class="d-none d-md-block col-6 text-muted">
                            <div class="row no-gutters align-items-center">
                                <div class="col-3">Tópicos</div>
                                <div class="col-3">Posts</div>
                                <div class="col-6">Último Tópico</div>
                            </div>
                        </div>
                    </div>
                </div>
                @forelse($category->forums as $forum)
                    @if($forum->getPermission() != null && $forum->getPermission()->view_forum)
                    <div class="card-body py-3">

                        <div class="row no-gutters align-items-center">
                            <div class="col">
                                <i class="fas fa-file-alt fa-2x mr-4"></i>
                                <a href="{{ route('forum.topics', [$forum->id, $forum->slug], ['class' => 'text-big font-weight-semibold']) }}">{{ $forum->name }}</a>
                                <div class="text-muted small ml-5">{{ $forum->description }}</div>
                            </div>
                            <div class="d-none d-md-block col-6">

                                <div class="row no-gutters align-items-center">
                                    <div class="col-3">{{ $forum->forum_topics->count() }}</div>
                                    <div class="col-3">{{ $forum->forum_posts->count() }}</div>
                                    <div class="media col-6 align-items-center">
                                        @if($forum->forum_posts->count() > 0)
                                            @if(empty($forum->forum_topics->last()->last_post_user_name))
                                                <img src="{{ $forum->forum_topics->last()->first_user->getAvatar() }}" alt="" class="d-block ui-w-30 rounded-circle">
                                                <div class="media-body flex-truncate ml-2">
                                                    <a href="{{ route('forum.topic', [$forum->forum_topics->last()->id, $forum->forum_topics->last()->slug]) }}" class="d-block text-truncate">
                                                        {{ $forum->forum_topics->last()->name }}
                                                    </a>
                                                    <div class="text-muted small text-truncate">
                                                        {{ $forum->forum_topics->last()->updated_at->format('d/m/Y H:i') }}
                                                        &nbsp;·&nbsp;
                                                        <a href="{{ route('user.profile', [strtolower($forum->forum_topics->last()->first_post_user_name)]) }}" class="text-info">
                                                            {{ $forum->forum_topics->last()->first_post_user_name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @else
                                                <img src="{{ $forum->forum_topics->last()->last_user->getAvatar() }}" alt="" class="d-block ui-w-30 rounded-circle">
                                                <div class="media-body flex-truncate ml-2">
                                                    <a href="{{ route('forum.topic', [$forum->forum_topics->last()->id, $forum->forum_topics->last()->slug]) }}" class="d-block text-truncate">
                                                        {{ $forum->forum_topics->last()->name }}
                                                    </a>
                                                    <div class="text-muted small text-truncate">
                                                        {{ $forum->forum_topics->last()->updated_at->format('d/m/Y H:i') }}
                                                        &nbsp;·&nbsp;
                                                        <a href="{{ route('user.profile', [strtolower($forum->forum_topics->last()->last_post_user_name)]) }}" class="text-info">
                                                            {{ $forum->forum_topics->last()->last_post_user_name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @else
                                            <span class="last-wrapper text-overflow">Sem posts</span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    @endif
                    <hr class="m-0">
                @empty
                    <div class="card-body py-3">
                        <p class="text-center">Nenhum forum no momento.</p>
                    </div>
                @endforelse
            </div>
        @endforeach
    @else
        <p class="text-center"><b>Forum fechado para manutenção momento.</b></p>
    @endif

@endsection
