@extends('layouts.dashboard')

@section('title', 'Tópicos Recentes')

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
                            <li class="breadcrumb-item active" aria-current="page">Tópicos Recentes</li>
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
                        <h4 class="card-title">Tópicos Recentes</h4>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
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
                                            {{ link_to_route('forum.threads', $result->forum->name, ['forum_id' => $result->forum->id, 'slug' => $result->forum->slug]) }}
                                        </th>
                                        <td>
                                            {{ link_to_route('forum.topic', $result->name, ['topic_id' => $result->id, 'slug' => $result->slug]) }}
                                            @if ($result->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($result->is_pinned)
                                                <span class="badge badge-success">Pinned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($result->first_post_username)]) }}">
                                                {{ $result->first_post_username }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $result->posts->count() - 1 }} Respostas / {{ $result->views }} Views
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($result->last_post_username)]) }}">
                                                {{ $result->last_post_username }}
                                            </a>,
                                            @if($result->updated_at && $result->updated_at != null)
                                                <time datetime="{{ format_date_time($result->updated_at) }}">
                                                    {{ format_date_time($result->updated_at) }}
                                                </time>
                                            @else
                                                <time datetime="N/A">N/A</time>
                                            @endif
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
