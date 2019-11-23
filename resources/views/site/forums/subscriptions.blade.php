@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3 h4">
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}"><i class="ion ion-ios-chatbubbles"></i> Fórum</a>
            </li>
            <li class="breadcrumb-item active">
                Favoritos
            </li>
        </ol>
        <div class="col-12 col-md-3 p-0 mb-3">
            {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
            {!! Form::hidden('sorting', 'created_at') !!}
            {!! Form::hidden('direction', 'desc') !!}
            {!! Form::hidden('subscribed', 1) !!}
            {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisa rápida de nome de tópico (dentro de assinaturas)', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    @include('site.forums.buttons')

    @includeIf('errors.errors', [$errors])

    <div class="card">
        <div class="card-header">Fóruns e Tópicos Favoritos</div>
        <table class="table card-table">
            <thead class="thead-light">
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
                                <a class="font-weight-bold" href="{{ route('forum_topic', ['id' => $t->id, 'slug' => $t->slug]) }}">
                                    {{ $t->name }}
                                </a>
                                @if ($result->topic->is_closed == true)
                                    <span class="badge badge-default">Fechado</span>
                                @endif
                                @if ($result->topic->is_pinned == true)
                                    <span class="badge badge-success">Pinned</span>
                                @endif
                            </td>
                            <td class="f-display-topic-started">
                                <a href="{{ route('user.profile', ['slug' => Str::slug($t->first_post_user_name)]) }}">
                                    {{ $t->first_post_user_name }}
                                </a>
                            </td>
                            <td class="f-display-topic-stats">
                                {{ $t->num_post - 1 }} Respostas / {{ $t->views }} Views
                            </td>
                            <td class="f-display-topic-last-post">
                                <a href="{{ route('user.profile', ['slug' => Str::slug($t->last_post_user_name)]) }}">
                                    {{ $t->last_post_user_name }}
                                </a>,
                                @if($t->updated_at && $t->updated_at != null)
                                    <time datetime="{{ date('d/m/Y h:m', strtotime($t->updated_at)) }}">
                                        {{ date('M d Y', strtotime($t->updated_at)) }}
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

        <div class="d-flex mt-5">
            <div class="mx-auto">
                {{ $results->links() }}
            </div>
        </div>

    </div>

@endsection
