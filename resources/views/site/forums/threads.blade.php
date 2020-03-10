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
        @includeIf('errors.errors', [$errors])
        @include('includes.messages')

        <div class="row">
            <div class="col-12">
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $forum->name }}</h3>
                        @if($forum->getPermission()->start_topic)
                            <div class="mb-4">
                                <a href="{{ route('new.topic', ['forum_id' => $forum->id]) }}">
                                    <button type="button" class="btn btn-sm btn-primary btn-rounded">
                                        <i class="ion ion-md-add"></i> Novo Tópico
                                    </button>
                                </a>
                            </div>
                        @endif

                        <b>Moderadores: &nbsp;</b>
                        @foreach($moderators as $moderator)
                            {{ link_to_route('user.profile', $moderator->user->username, $moderator->user->slug, ['target' => '_blank']) }}&nbsp;
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
                                @forelse($threads as $thread)
                                    @if ($forum->getPermission()->read_topic)
                                        <tr>
                                            <th scope="row">
                                                {{ link_to_route('forum.topic', $thread->name, ['topic_id' => $thread->id, 'slug' => $thread->slug], ['class' => 'h5 text-info']) }}
                                                @if ($thread->is_locked)
                                                    <span class='badge badge-purple'>Fechado</span>
                                                @endif
                                                @if($thread->is_pinned)
                                                    <span class='badge badge-success'>Pin</span>
                                                @endif
                                                <div class="text-dark small mt-1">
                                                    Iniciado em {{ format_date_time($thread->created_at) }}&nbsp;·
                                                    Por {{ link_to_route('user.profile', $thread->first_post_username, [strtolower($thread->first_post_username)], ['class' => 'text-info']) }}
                                                </div>
                                            </th>
                                            <td class="align-middle">{{ $thread->num_post }}</td>
                                            <td class="align-middle">{{ $thread->views }}</td>
                                            <td>
                                                @if(empty($thread->last_post_username))
                                                    <div class="text-dark small mt-1">
                                                        {{ format_date_time($thread->updated_at) }} <br>
                                                        Por {{ link_to_route('user.profile', $thread->first_post_username, [strtolower($thread->first_post_username)], ['class' => 'text-info text-truncate']) }}
                                                    </div>
                                                @else
                                                    <div class="text-dark small mt-1">
                                                        {{ format_date_time($thread->updated_at) }} <br>
                                                        Por {{ link_to_route('user.profile', $thread->last_post_username, [strtolower($thread->last_post_username)], ['class' => 'text-info text-truncate']) }}
                                                    </div>
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
