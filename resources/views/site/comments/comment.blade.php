@extends('layouts.dashboard')

@section('title', 'Conquistas')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Comentário</li>
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
                        <h4 class="card-title">Comentário feito em</h4>
                        <h6 class="card-subtitle">
                            @if($comment->actor)
                                <b class="text-danger">Atrizes e Atores</b>:
                                <a class="ml-2" href="{{ route('actor.show', [$comment->actor->id, $comment->actor->slug]) }}" target="_blank">{{ $comment->actor->name }}</a>
                            @endif
                            @if($comment->calendar)
                                <b class="text-danger">Calendário</b>:
                                <a class="ml-2" href="{{ route('calendars.show', [$comment->calendar->id, $comment->calendar->slug]) }}" target="_blank">{{ $comment->calendar->name }}</a>
                            @endif
                            @if($comment->character)
                                <b class="text-danger">Personagem</b>:
                                <a class="ml-2" href="{{ route('character.show', [$comment->character->id, $comment->character->slug]) }}" target="_blank">{{ $comment->character->name }}</a>
                            @endif
                            @if($comment->fansub)
                                <b class="text-danger">Fansub</b>:
                                <a class="ml-2" href="{{ route('fansub.show', [$comment->fansub->id, $comment->fansub->slug]) }}" target="_blank">{{ $comment->fansub->name }}</a>
                            @endif
                            @if($comment->media)
                                <b class="text-danger">Mídia</b>:
                                <a class="ml-2" href="{{ route('media.show', [$comment->media->id, $comment->media->slug]) }}" target="_blank">{{ $comment->media->name }}</a>
                            @endif
                            @if($comment->studio)
                                <b class="text-danger">Estúdio</b>:
                                <a class="ml-2" href="{{ route('media.show', [$comment->studio->id, $comment->studio->slug]) }}" target="_blank">{{ $comment->studio->name }}</a>
                            @endif
                            @if($comment->torrent)
                                <b class="text-danger">Torrent</b>:
                                <a class="ml-2" href="{{ route('torrent.show', [$comment->torrent->id, $comment->torrent->slug]) }}" target="_blank">{{ $comment->torrent->name }}</a>
                            @endif
                        </h6>

                        <div class="media pb-1 mb-3">
                            <img src="{{ $comment->user->avatar() }}" class="d-block ui-w-40 rounded-circle" alt="avatar">
                            <div class="media-body ml-3">
                                {{ link_to_route('user.profile', $comment->user->username, ['slug' => $comment->user->slug]) }}
                                @if($comment->is_spoiler)
                                    <mark class="text-danger">Spoiler!</mark>
                                @endif
                                <p class="my-1">{{ $comment->content }}</p>
                                <div class="clearfix">
                                    <span class="float-left text-muted small mr-3">{{ $comment->created_at->format('d/m/Y H:i') }}</span>

                                    @if($comment->user_id == auth()->user()->id || auth()->user()->can('painel-staff'))
                                        <a href="{{ route('comments.edit', [$comment->id]) }}">
                                            <button type="button" class="btn btn-xs btn-primary">
                                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Comentário"></span>
                                            </button>
                                        </a>
                                    @endif

                                    @if($comment->user_id == auth()->user()->id || auth()->user()->can('painel-staff'))
                                        <a href="javascript:;" onclick="document.getElementById('comment-del-{{ $comment->id }}').submit();">
                                            <i class="fas fa-times" data-toggle="tooltip" title="Deletar Comentário"></i>
                                        </a>
                                        {!! Form::open(['url' => 'comments/' . $comment->id, 'method' => 'DELETE', 'id' => 'comment-del-' . $comment->id , 'style' => 'display: none']) !!}
                                        {!! Form::close() !!}
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
