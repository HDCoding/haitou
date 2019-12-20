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
                    {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisa rápida de nome de tópico (dentro de assinaturas)', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                    {!! Form::close() !!}
                </div>
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Últimas Postagens</h4>
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
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <th>
                                            <span class="badge badge-extra text-bold">{{ $result->topic->forum->name }}</span>
                                        </th>
                                        <td>
                                            <a class="font-weight-bold" href="{{ route('forum.topic', ['id' => $result->topic->id, 'slug' => $result->topic->slug]) }}">
                                                {{ $result->topic->name }}
                                            </a>
                                            @if ($result->topic->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($result->topic->is_pinned)
                                                <span class="badge badge-success">Pin</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($result->topic->first_post_username)]) }}">
                                                {{ $result->topic->first_post_username }}
                                            </a>
                                        </td>
                                        <td>
{{--                                            {{ $result->posts->count() - 1 }} Respostas / {{ $result->views }} Views--}}
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($result->topic->last_post_username)]) }}">{{ $result->topic->last_post_username }}</a>,
                                            <time datetime="{{ format_date($result->topic->updated_at) }}">
                                                {{ format_date($result->topic->updated_at) }}
                                            </time>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="some-padding button-padding">
                                            <div class="topic-posts button-padding">
                                                <div class="post" id="post-{{$result->id}}">
                                                    <div class="button-holder">
                                                        <div class="button-left">
                                                            <a href="{{ route('user.profile', ['slug' => $result->user->slug]) }}" style="color:{{ $result->user->group->color }}; display:inline;">
                                                                {{ $result->user->name }}
                                                            </a>
                                                            @ {{ format_date_time($result->created_at) }}
                                                        </div>
                                                        <div class="button-right">
                                                            <a class="font-weight-bold" href="{{ route('forum.topic', ['id' => $result->topic->id, 'slug' => $result->topic->slug]) }}?page={{$result->pageNumber()}}#post-{{$result->id}}">#{{$result->id}}</a>
                                                        </div>
                                                    </div>
                                                    <hr class="some-margin">
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
