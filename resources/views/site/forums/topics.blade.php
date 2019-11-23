@extends('layouts.dashboard')

@section('subtitle', 'Topics')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3">
            <li class="breadcrumb-item">
                <a href="{{ url('forum')}}">
                    <i class="ion ion-ios-chatbubbles"></i> Forum
                </a>
            </li>
            <li class="breadcrumb-item active">{{ $forum->name }}</li>
        </ol>
    </div>

    @if($forum->getPermission()->start_topic)
    <div class="mb-4">
        <a href="{{ route('new.topic', [$forum->id, $forum->slug]) }}">
            <button type="button" class="btn btn-primary"><i class="ion ion-md-add"></i>&nbsp; Novo Tópico</button>
        </a>
    </div>
    @endif

    @includeIf('errors.errors', [$errors])

    <b>Moderadores: &nbsp;</b>
    @foreach($moderators as $moderator)
        @if($moderator->forum_id == $forum->id)
            {{ link_to_route('user.profile', $moderator->staff->name, ['slug' => $moderator->staff->slug], ['target' => '_blank']) }}
            &nbsp;
        @endif
    @endforeach

    <div class="card mb-3 mt-3">
        <div class="card-header d-none d-md-block">
            <div class="row no-gutters align-items-center">
                <div class="col"></div>
                <div class="col-4 text-muted">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2">Posts</div>
                        <div class="col-2">Views</div>
                        <div class="col-8">Último Post</div>
                    </div>
                </div>
            </div>
        </div>

        @forelse($topics as $topic)
            @if ($forum->getPermission()->read_topic)
            <div class="card-body py-3">

                <div class="row no-gutters align-items-center">
                    <div class="col">
                        <a href="{{ route('forum.topic', [$topic->id, $topic->slug]) }}" class="text-big">{{ $topic->name }}</a>
                        @if($topic->is_locked)
                        <span class="badge badge-default align-text-bottom ml-1">Trancado</span>
                        @endif
                        <div class="text-muted small mt-1">
                            Iniciado em {{ $topic->created_at->format('d/m/Y H:i') }}&nbsp;·&nbsp;
                            Por <a href="{{ route('user.profile', [$forum->forum_topics->last()->first_user->slug]) }}" class="text-muted">
                                {{ $forum->forum_topics->last()->first_user->name }}
                            </a>
                        </div>
                    </div>
                    <div class="d-none d-md-block col-4">

                        <div class="row no-gutters align-items-center">
                            <div class="col-2">{{ $topic->forum_posts->count() - 1 }}</div>
                            <div class="col-2">{{ $topic->views }}</div>
                            <div class="media col-8 align-items-center">
                                @if($forum->forum_posts->count() > 0)
                                    @if(empty($forum->forum_topics->last()->last_post_user_name))
                                        <img src="{{ $forum->forum_topics->last()->first_user->getAvatar() }}" alt="" class="d-block ui-w-30 rounded-circle">
                                        <div class="media-body flex-truncate ml-2">
                                            <div class="line-height-1 text-truncate">
                                                {{ $forum->forum_topics->last()->updated_at->format('d/m/Y H:i') }}
                                            </div>
                                            Por <a href="{{ route('user.profile', [strtolower($forum->forum_topics->last()->first_post_user_name)]) }}" class="text-info text-truncate">
                                                {{ $forum->forum_topics->last()->first_post_user_name }}
                                            </a>
                                        </div>
                                    @else
                                        <img src="{{ $forum->forum_topics->last()->last_user->getAvatar() }}" alt="" class="d-block ui-w-30 rounded-circle">
                                        <div class="media-body flex-truncate ml-2">
                                            <div class="line-height-1 text-truncate">{{ $forum->forum_topics->last()->updated_at->format('d/m/Y H:i') }}</div>
                                            Por <a href="{{ route('user.profile', [strtolower($forum->forum_topics->last()->last_post_user_name)]) }}" class="text-info text-truncate">
                                                {{ $forum->forum_topics->last()->last_post_user_name }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            </div>

                        </div>

                    </div>
                </div>

            </div>
            <hr class="m-0">
            @endif
        @empty
            <div class="card-body py-3">
                <p class="text-center">Nenhum tópico até o momento.</p>
            </div>
        @endforelse
    </div>

@endsection
