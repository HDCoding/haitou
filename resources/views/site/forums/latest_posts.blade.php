@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('content')

    <div class="d-flex flex-wrap justify-content-between align-items-center pt-3 mb-4">
        <ol class="breadcrumb font-weight-bold mb-3 h4">
            <li class="breadcrumb-item">
                <a href="{{ url('forum') }}"><i class="ion ion-ios-chatbubbles"></i> Fórum</a>
            </li>
            <li class="breadcrumb-item active">
                Últimas Postagens
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

    @include('site.forums.buttons')

    <div class="card">
        <div class="card-header">Últimas Postagens</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Fórum</th>
                    <th>Tópico</th>
                    <th>Autor</th>
                    <th>Estatísticas</th>
                    <th>Última Informação</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr>
                    <th>
                        <span class="badge badge-extra text-bold">{{ $result->topic->forum->name }}</span>
                    </th>
                    <td>
                        <a class="font-weight-bold" href="{{ route('forum_topic', ['id' => $result->topic->id, 'slug' => $result->topic->slug]) }}">
                            {{ $result->topic->name }}
                        </a>
                        @if ($result->topic->is_closed == true)
                            <span class="badge badge-dark">Fechadas</span>
                        @endif
                        @if ($result->topic->is_pinned == true)
                            <span class="badge badge-success">Pin</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user.profile', ['slug' => Str::slug($result->topic->first_post_user_name)]) }}">
                            {{ $result->topic->first_post_user_name }}
                        </a>
                    </td>
                    <td>
                        {{ $result->num_post - 1 }} Respostas / {{ $result->views }} Views
                    </td>
                    <td>
                        <a href="{{ route('user.profile', ['slug' => Str::slug($result->topic->last_post_user_name)]) }}">{{ $result->topic->last_post_user_name }}</a>,
                        <time datetime="{{ date('d-m-Y h:m', strtotime($result->topic->updated_at)) }}">
                            {{ date('M d Y', strtotime($result->topic->updated_at)) }}
                        </time>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="some-padding button-padding">
                        <div class="topic-posts button-padding">
                            <div class="post" id="post-{{$result->id}}">
                                <div class="button-holder">
                                    <div class="button-left">
                                        <a href="{{ route('user.profile', ['slug' => $result->user->slug]) }}" style="color:{{ $result->user->role->color }}; display:inline;">
                                            {{ $result->user->name }}
                                        </a>
                                        @ {{ date('M d Y h:i:s', $result->created_at->getTimestamp()) }}
                                    </div>
                                    <div class="button-right">
                                        <a class="font-weight-bold" href="{{ route('forum_topic', ['id' => $result->topic->id, 'slug' => $result->topic->slug]) }}?page={{$result->getPageNumber()}}#post-{{$result->id}}">#{{$result->id}}</a>
                                    </div>
                                </div>
                                <hr class="some-margin">
                                {!! $result->getContentHtml() !!}
                            </div>
                        </div>
                    </td>
                </tr>
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
