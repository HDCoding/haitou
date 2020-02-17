@extends('layouts.dashboard')

@section('title', 'Últimas Postagens')

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
                            <li class="breadcrumb-item active" aria-current="page">Últimas Postagens</li>
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
                        <h4 class="card-title">Últimas Postagens</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Autor(a)</th>
                                    <th>Estatísticas</th>
                                    <th>Última Informação</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <th>
                                            <a class="font-weight-bold" href="{{ route('forum.topic', ['topic_id' => $result->topic->id, 'slug' => $result->topic->slug]) }}?page={{ $result->pageNumber() }}#post-{{ $result->id }}">#{{ $result->id }}</a>
                                        </th>
                                        <td>
                                            {{ link_to_route('forum.threads', $result->topic->forum->name, ['forum_id' => $result->topic->forum->id, 'slug' => $result->topic->forum->slug]) }}
                                        </td>
                                        <td>
                                            {{ link_to_route('forum.topic', $result->topic->name, ['topic_id' => $result->topic->id, 'slug' => $result->topic->slug], ['class' => 'font-weight-bold']) }}
                                            @if ($result->topic->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($result->topic->is_pinned)
                                                <span class="badge badge-success">Pin</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ link_to_route('user.profile', $result->topic->first_post_username, [strtolower($result->topic->first_post_username)], ['class' => 'text-info']) }}
                                        </td>
                                        <td>
                                            {{ $result->topic->num_post }} Respostas / {{ $result->topic->views }} Views
                                        </td>
                                        <td>
                                            {{ link_to_route('user.profile', $result->topic->last_post_username, [strtolower($result->topic->last_post_username)], ['class' => 'text-info']) }}
                                            -
                                            @if($result->updated_at && $result->updated_at != null)
                                                <time datetime="{{ format_date_time($result->updated_at) }}">
                                                    {{ format_date_time($result->updated_at) }}
                                                </time>
                                            @else
                                                <time datetime="N/A">N/A</time>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="some-padding button-padding">
                                            <div class="topic-posts button-padding">
                                                <div class="post" id="post-{{ $result->id }}">
                                                    {!! $result->contentHtml() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
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
