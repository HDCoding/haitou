@extends('layouts.dashboard')

@section('title', 'Pesquisar')

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
                            <li class="breadcrumb-item active" aria-current="page">Pesquisar</li>
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
                        <h4 class="card-title">Pesquisa no fórum</h4>

                        @includeIf('errors.errors', [$errors])

                        @include('site.forums.buttons')

                        <form class="form-horizontal m-t4" role="form" method="GET" action="{{ route('forum.search') }}">
                            @csrf
                            <div class="form-group">
                                <label for="name">Tópico</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Tópico" value="{{ (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : '') }}">
                            </div>
                            <div class="form-group">
                                <label for="body">Post</label>
                                <input type="text" class="form-control" name="body" id="body" placeholder="Post" value="{{ (isset($params) && is_array($params) && array_key_exists('body', $params) ? $params['body'] : '') }}">
                            </div>

                            <div class="form-group">
                                <label for="category">Fórum</label>
                                <select id="category" name="category" class="form-control">
                                    <option value="">Todas as categorias/Fóruns</option>
                                    @foreach ($categories as $category)
                                        @if($category->getPermission() != null && $category->getPermission()->view_forum == true)
                                            <option value="{{ $category->id }}" {{ (isset($params) && is_array($params) && array_key_exists('category', $params) && $params['category'] == $category->id ? 'selected' : '') }}>
                                                {{ $category->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="type">Rótulo</label>
                                <div class="col-sm-10">
                                    <span class="badge-user">
                                        <label class="inline">
                                            @if(isset($params) && is_array($params) && array_key_exists('is_locked', $params) && $params['is_locked'] == 1)
                                                <input type="checkbox" value="1" name="is_locked" checked>
                                                <span class="fa fa-check text-purple"></span> Trancado
                                            @else
                                                <input type="checkbox" value="1" name="is_locked">
                                                <span class="fa fa-check text-purple"></span> Trancado
                                            @endif
                                        </label>
                                    </span>
                                    <span class="badge-user">
                                        <label class="inline">
                                            @if(isset($params) && is_array($params) && array_key_exists('is_pinned', $params) && $params['is_pinned'] == 1)
                                                <input type="checkbox" value="1" name="is_pinned" checked>
                                                <span class="fa fa-tag text-success"></span> Pin
                                            @else
                                                <input type="checkbox" value="1" name="is_pinned">
                                                <span class="fa fa-tag text-success"></span> Pin
                                            @endif
                                        </label>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="body">Atividade</label>
                                <div class="col-sm-10">
                                    <span class="badge-user">
                                        <label class="inline">
                                            @if(isset($params) && is_array($params) && array_key_exists('subscribed', $params) && $params['subscribed'] == 1)
                                                <input type="checkbox" value="1" name="subscribed" checked>
                                                <span class="fa fa-bell text-success"></span> Subscrito
                                            @else
                                                <input type="checkbox" value="1" name="subscribed">
                                                <span class="fa fa-bell text-success"></span> Subscrito
                                            @endif
                                        </label>
                                    </span>
                                    <span class="badge-user">
                                        <label class="inline">
                                            @if(isset($params) && is_array($params) && array_key_exists('notsubscribed', $params) && $params['notsubscribed'] == 1)
                                                <input type="checkbox" value="1" name="notsubscribed" checked>
                                                <span class="fa fa-bell-slash text-danger"></span> Não inscrito
                                            @else
                                                <input type="checkbox" value="1" name="notsubscribed">
                                                <span class="fa fa-bell-slash text-danger"></span> Não inscrito
                                            @endif
                                        </label>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sorting">Data</label>
                                <select id="sorting" name="sorting" class="form-control">
                                    <option value="updated_at" {{ (isset($params) && is_array($params) && array_key_exists('sorting', $params) && $params['sorting'] == 'updated_at' ? 'selected' : '') }}>
                                        Atualizado em
                                    </option>
                                    <option value="created_at" {{ (isset($params) && is_array($params) && array_key_exists('sorting', $params) && $params['sorting'] == 'created_at' ? 'selected' : '') }}>
                                        Criado em
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="direction">Ordem</label>
                                <select id="direction" name="direction" class="form-control">
                                    <option value="desc" {{ (isset($params) && is_array($params) && array_key_exists('direction', $params) && $params['direction'] == 'desc' ? 'selected' : '') }}>
                                        Decrescente
                                    </option>
                                    <option value="asc" {{ (isset($params) && is_array($params) && array_key_exists('direction', $params) && $params['direction'] == 'asc' ? 'selected' : '') }}>
                                        Crescente
                                    </option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Atualizar resultados</button>
                        </form>

                        <div class="table-responsive m-t-30">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Autor(a)</th>
                                    <th>Stats</th>
                                    <th>Última Mensagem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td>
                                            <a href="{{ route('forum.topics', [$result->forum->id, $result->forum->slug]) }}">{{ $result->forum->name }}</a>
                                        </td>
                                        <td>
                                            <strong>
                                                <a href="{{ route('forum.topic', ['id' => $result->id, 'slug' => $result->slug]) }}">
                                                    {{ $result->name }}
                                                </a>
                                            </strong>
                                            @if ($result->is_locked == true)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($result->is_pinned == true)
                                                <span class="label label-sm label-success">Pin</span>
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
                                            <time datetime="{{ format_date($result->updated_at) }}">
                                                {{ format_date($result->updated_at) }}
                                            </time>
                                        </td>
                                    </tr>
                                    @if(isset($params) && is_array($params) && array_key_exists('body', $params))
                                        <tr>
                                            <td colspan="5" class="some-padding button-padding">
                                                <div class="topic-posts button-padding">
                                                    <div class="post" id="post-{{ $result->id }}">
                                                        <div class="button-holder">
                                                            <div class="button-left">
                                                                <a class="post-info-name" href="{{ route('user.profile', ['slug' => Str::slug($result->user->username)]) }}" style="color:{{ $result->user->group->color }}; display:inline;">{{ $result->user->username }}</a>
                                                                @ {{ format_date_time($result->created_at) }}
                                                            </div>
                                                            <div class="button-right">
                                                                <a class="text-bold" href="{{ route('forum.topic', ['id' => $result->id, 'slug' => $result->slug]) }}?page={{ $result->pageNumber() }}#post-{{ $result->id }}">#{{ $result->id }}</a>
                                                            </div>
                                                        </div>
                                                        <hr class="some-margin">
                                                        {!! $result->contentHtml()  !!}
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
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
