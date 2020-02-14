@extends('layouts.dashboard')

@section('title', 'Tópicos')

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
                            <li class="breadcrumb-item active" aria-current="page">{{ $forum->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $forum->name }}</h3>
                        @if($forum->getPermission()->start_topic)
                            <div class="mb-4">
                                <a href="{{ route('new.topic', ['forum_id' => $forum->id]) }}">
                                    <button type="button" class="btn btn-primary btn-rounded">
                                        <i class="ion ion-md-add"></i>&nbsp; Novo Tópico
                                    </button>
                                </a>
                                <a href="{{ route('new.poll', ['forum_id' => $forum->id]) }}">
                                    <button type="button" class="btn btn-info btn-rounded">
                                        <i class="fas fa-poll"></i>&nbsp; Nova Pesquisa
                                    </button>
                                </a>
                            </div>
                        @endif
                        @includeIf('errors.errors', [$errors])

                        <b>Moderadores: &nbsp;</b>
                        @foreach($moderators as $moderator)
                            @if($moderator->forum_id == $forum->id)
                                {{ link_to_route('user.profile', $moderator->user->username, $moderator->user->slug, ['target' => '_blank']) }}&nbsp;
                            @endif
                        @endforeach
                        <div class="table-responsive m-t-20">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Tópico</th>
                                    <th scope="col">Posts</th>
                                    <th scope="col">Views</th>
                                    <th scope="col">Último Post</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($topics as $topic)
                                    @if ($forum->getPermission()->read_topic)
                                        <tr>
                                            <th scope="row">
                                                @if($topic->is_locked)
                                                    <i class="fas fa-lock fa-2x mr-4"></i>
                                                @endif
                                                <a class="h5 text-info" href="{{ route('forum.topic', [$topic->id, $topic->slug]) }}">{{ $topic->name }}</a>
                                                <div class="text-muted small mt-1">
                                                    Iniciado em {{ format_date_time($topic->created_at) }}&nbsp;·&nbsp;
                                                    Por <a class="text-info" href="{{ route('user.profile', [$forum->topics->last()->first_user->slug]) }}">
                                                        {{ $forum->topics->last()->first_post_username }}
                                                    </a>
                                                </div>
                                            </th>
                                            <td>{{ $topic->posts->count() - 1 }}</td>
                                            <td>{{ $topic->views }}</td>
                                            <td>
                                                @if($forum->posts->count() > 0)
                                                    @if(empty($forum->topics->last()->last_post_username))
                                                        <div class="ml-2">
                                                            <div class="text-truncate">
                                                                {{ format_date_time($forum->topics->last()->updated_at) }}
                                                            </div>
                                                            Por <a class="text-info text-truncate" href="{{ route('user.profile', [strtolower($forum->topics->last()->first_post_username)]) }}">
                                                                {{ $forum->topics->last()->first_post_username }}
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="ml-2">
                                                            <div class="text-truncate">
                                                                {{ format_date_time($forum->topics->last()->updated_at) }}
                                                            </div>
                                                            Por <a class="text-info text-truncate" href="{{ route('user.profile', [strtolower($forum->topics->last()->last_post_username)]) }}">
                                                                {{ $forum->topics->last()->last_post_username }}
                                                            </a>
                                                        </div>
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @empty
                                    <tr class="py-3">
                                        <td class="text-center" colspan="4">Nenhum tópico até o momento.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
