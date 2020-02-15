@extends('layouts.dashboard')

@section('title', 'Favoritos')

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
                            <li class="breadcrumb-item active" aria-current="page">Favoritos</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="col-12 col-md-3 p-0 mb-3">
                    {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
                    {!! Form::hidden('sorting', 'created_at') !!}
                    {!! Form::hidden('direction', 'desc') !!}
                    {!! Form::hidden('subscribed', 1) !!}
                    {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisa rápida...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                    {!! Form::close() !!}
                </div>
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tópicos Favoritos</h4>
                        @includeIf('errors.errors', [$errors])
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Autor(a)</th>
                                    <th>Estatísticas</th>
                                    <th>Última Mensagem</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $result)

                                    @if ($result->subscription_topics)

                                        @foreach($result->subscription_topics as $topic)
                                            <tr>
                                                <th>
                                                    {{ link_to_route('forum.threads', $topic->forum->name, ['forum_id' => $topic->forum->id, 'slug' => $topic->forum->slug]) }}
                                                </th>
                                                <td>
                                                    {{ link_to_route('forum.topic', $topic->name, ['topic_id' => $topic->id, 'slug' => $topic->slug]) }}
                                                    @if ($topic->is_locked)
                                                        <span class="badge badge-dark">Fechado</span>
                                                    @endif
                                                    @if ($topic->is_pinned)
                                                        <span class="badge badge-success">Pinned</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.profile', ['slug' => Str::slug($topic->first_post_username)]) }}">
                                                        {{ $topic->first_post_username }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $topic->posts->count() - 1 }} Respostas / {{ $topic->views }} Views
                                                </td>
                                                <td>
                                                    <a href="{{ route('user.profile', ['slug' => Str::slug($topic->last_post_username)]) }}">
                                                        {{ $topic->last_post_username }}
                                                    </a>,
                                                    @if($topic->updated_at && $topic->updated_at != null)
                                                        <time datetime="{{ format_date_time($topic->updated_at) }}">
                                                            {{ format_date_time($topic->updated_at) }}
                                                        </time>
                                                    @else
                                                        <time datetime="N/A">N/A</time>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (auth()->user()->isSubscribed($topic->id))
                                                        <a href="{{ route('unsubscribe.topic', ['topic_id' => $topic->id]) }}" class="badge badge-danger" data-toggle="tooltip" title="Cancelar Inscrição">
                                                            <i class="fas fa-bell-slash"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('subscribe.topic', ['topic_id' => $topic->id]) }}" class="badge badge-success" data-toggle="tooltip" title="Se Inscrever">
                                                            <i class="fas fa-bell"></i>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->topicNotification($topic->id))
                                                        <a href="{{ route('topic.notify.off', ['topic_id' => $topic->id]) }}" class="badge badge-danger" data-toggle="tooltip" title="Cancelar Notificacao">
                                                            <i class="fas fa-toggle-on"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('topic.notify.on', ['topic_id' => $topic->id]) }}" class="badge badge-info" data-toggle="tooltip" title="Notificar">
                                                            <i class="fas fa-toggle-off"></i>
                                                        </a>
                                                    @endif
                                                    @if(auth()->user()->topicEmailNotification($topic->id))
                                                        <a href="{{ route('topic.email.notify.off', ['topic_id' => $topic->id]) }}" class="badge badge-danger" data-toggle="tooltip" title="Cancelar envio por Email">
                                                            <i class="fas fa-mail-bulk"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('topic.email.notify.on', ['topic_id' => $topic->id]) }}" class="badge badge-purple" data-toggle="tooltip" title="Liberar envio por Email">
                                                            <i class="fas fa-mail-bulk"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif

                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $results->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
