@extends('layouts.dashboard')

@section('title', 'Inscrições')

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
                            <li class="breadcrumb-item active" aria-current="page">Inscrições</li>
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
                    {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisa rápida de nome de tópico (dentro de assinaturas)', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                    {!! Form::close() !!}
                </div>
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Fóruns e Tópicos Inscrições</h4>
                        @includeIf('errors.errors', [$errors])
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Autor</th>
                                    <th>Estatísticas</th>
                                    <th>Última Informação</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $result)

                                    @if (in_array($result->id, $forum_neos))
                                        <tr>
                                            <th class="f-display-topic-icon">
                                                <a href="{{ route('forum.topics', ['id' => $result->id, 'slug' => $result->slug]) }}">
                                                    <span class="badge-extra text-bold">{{ $result->name }}</span>
                                                </a>
                                            </th>
                                            <td class="f-display-topic-title">--</td>
                                            <td class="f-display-topic-started">--</td>
                                            <td class="f-display-topic-stats">--</td>
                                            <td class="f-display-topic-last-post">--</td>
                                            <td class="f-display-topic-stats">
                                                @if (auth()->user()->isSubscribed('forum', $result->id))
                                                    <a href="{{ route('unsubscribe_forum', ['forum' => $result->id, 'route' => 'subscriptions']) }}" class="label label-sm label-danger">
                                                        <i class="fa fa-bell-slash"></i> Cancelar inscrição</a>
                                                @else
                                                    <a href="{{ route('subscribe_forum', ['forum' => $result->id, 'route' => 'subscriptions']) }}" class="label label-sm label-success">
                                                        <i class="fa fa-bell"></i> Se inscrever</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endif

                                    @if ($result->subscription_topics)

                                        @foreach($result->subscription_topics as $t)
                                            <tr>
                                                <th class="f-display-topic-icon">
                                                    <span class="badge-extra text-bold">{{ $t->forum->name }}</span>
                                                </th>
                                                <td class="f-display-topic-title">
                                                    <a class="h5 text-info" href="{{ route('forum.topic', [$t->id, $t->slug]) }}">{{ $t->name }}</a>
                                                    @if ($t->is_locked)
                                                        <span class="badge badge-danger">Fechado</span>
                                                    @endif
                                                    @if ($t->is_pinned)
                                                        <span class="badge badge-success">Pinned</span>
                                                    @endif
                                                </td>
                                                <td class="f-display-topic-started">
                                                    <a href="{{ route('user.profile', ['slug' => Str::slug($t->first_post_username)]) }}">
                                                        {{ $t->first_post_username }}
                                                    </a>
                                                </td>
                                                <td class="f-display-topic-stats">
                                                    {{ $t->posts->count() - 1 }} Respostas / {{ $t->views }} Views
                                                </td>
                                                <td class="f-display-topic-last-post">
                                                    <a href="{{ route('user.profile', ['slug' => Str::slug($t->last_post_username)]) }}">
                                                        {{ $t->last_post_username }}
                                                    </a>,
                                                    @if($t->updated_at && $t->updated_at != null)
                                                        <time datetime="{{ format_date_time($t->updated_at) }}">
                                                            {{ format_date_time($t->updated_at) }}
                                                        </time>
                                                    @else
                                                        <time datetime="N/A">N/A</time>
                                                    @endif
                                                </td>
                                                <td class="f-display-topic-stats">
                                                    @if (auth()->user()->isSubscribed('topic', $t->id))
                                                        <a href="{{ route('unsubscribe_topic', ['topic' => $t->id, 'route' => 'subscriptions']) }}" class="badge badge-danger">
                                                            <i class="fa fa-bell-slash"></i> Cancelar inscrição
                                                        </a>
                                                    @else
                                                        <a href="{{ route('subscribe_topic', ['topic' => $t->id, 'route' => 'subscriptions']) }}" class="badge badge-success">
                                                            <i class="fa fa-bell"></i> Se Inscrever
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
