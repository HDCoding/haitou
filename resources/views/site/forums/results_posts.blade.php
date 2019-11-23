@extends('layouts.dashboard')

@section('subtitle', 'Forum')

@section('content')

    <div class="box container">

        @includeIf('errors.errors', [$errors])

        @include('site.forums.buttons')

        <div class="forum-categories">
            <table class="table table-bordered table-hover">
                <thead class="no-space">
                    <tr class="no-space">
                        <td colspan="5" class="no-space">
                            <div class="header gradient teal some-padding">
                                <div class="inner_content">
                                    <h1 class="no-space">Forum Post Search</h1>
                                </div>
                            </div>
                        </td>
                    </tr>
                </thead>
                <thead class="no-space">
                <tr>
                    <td colspan="5">
                        <div>
                            <div class="box">
                                <div class="container well search mt-5 fatten-me table-me" style="width: 90% !important; margin: auto !important;">
                                    <form role="form" method="GET" action="{{ route('forum.search') }}" class="form-horizontal form-condensed form-torrent-search form-bordered table-me">
                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="name" class="mt-5 col-sm-1 label label-default fatten-me">Tópico</label>
                                            <div class="col-sm-9 fatten-me">
                                                <label>
                                                    <input type="text" name="name" placeholder="Tópico" value="{{ (isset($params) && is_array($params) && array_key_exists('name',$params) ? $params['name'] : '') }}" class="form-control">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="body" class="mt-5 col-sm-1 label label-default fatten-me">Post</label>
                                            <div class="col-sm-9 fatten-me">
                                                <label>
                                                    <input type="text" name="body" placeholder="Post" value="{{ (isset($params) && is_array($params) && array_key_exists('body',$params) ? $params['body'] : '') }}" class="form-control">
                                                </label>
                                            </div>
                                        </div>

                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="sort" class="mt-5 col-sm-1 label label-default fatten-me">@lang('common.forum')</label>
                                            <div class="col-sm-9 fatten-me">
                                                <label for="category"></label><select id="category" name="category" class="form-control">
                                                    <option value="">Todas as categorias/Fóruns</option>
                                                    @foreach ($categories as $category)
                                                        @if ($category->getPermission() != null && $category->getPermission()->show_forum == true && $category->getForumsInCategory()->count() > 0)
                                                            <option value="{{ $category->id }}" {{ (isset($params) && is_array($params) && array_key_exists('category',$params) && $params['category'] == $category->id ? 'SELECTED' : '') }}>{{ $category->name }}</option>
                                                            @foreach ($category->getForumsInCategory()->sortBy('position') as $categoryChild)
                                                                @if ($categoryChild->getPermission() != null && $categoryChild->getPermission()->show_forum == true)
                                                                    <option value="{{ $categoryChild->id }}" {{ (isset($params) && is_array($params) && array_key_exists('category',$params) && $params['category'] == $categoryChild->id ? 'SELECTED' : '') }}>&raquo; {{ $categoryChild->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="type" class="mt-5 col-sm-1 label label-default fatten-me">@lang('forum.label')</label>
                                            <div class="col-sm-10">
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('is_locked', $params) && $params['is_locked'] == 1)
                                                            <input type="checkbox" value="1" name="is_locked" checked>
                                                            <span class="fa fa-check text-purple"></span> Implementado
                                                        @else
                                                            <input type="checkbox" value="1" name="is_locked">
                                                            <span class="fa fa-check text-purple"></span> Implementado
                                                        @endif
                                                    </label>
                                                </span>
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('is_pinned', $params) && $params['is_pinned'] == 1)
                                                            <input type="checkbox" value="1" name="is_pinned" checked>
                                                            <span class="fa fa-tag text-green"></span> Aprovado
                                                        @else
                                                            <input type="checkbox" value="1" name="is_pinned">
                                                            <span class="fa fa-tag text-green"></span> Aprovado
                                                        @endif
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="type" class="mt-5 col-sm-1 label label-default fatten-me">Estado</label>
                                            <div class="col-sm-10">
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('open',$params) && $params['open'] == 1)
                                                            <input type="checkbox" value="1" name="open" checked> <span class="{{ config('other.font-awesome') }} fa-lock-open text-green"></span> @lang('forum.open')
                                                        @else
                                                            <input type="checkbox" value="1" name="open"> <span class="{{ config('other.font-awesome') }} fa-lock-open text-green"></span> @lang('forum.open')
                                                        @endif
                                                    </label>
                                                </span>
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('closed',$params) && $params['closed'] == 1)
                                                            <input type="checkbox" value="1" name="closed" checked> <span class="{{ config('other.font-awesome') }} fa-lock text-red"></span> @lang('forum.closed')
                                                        @else
                                                            <input type="checkbox" value="1" name="closed"> <span class="{{ config('other.font-awesome') }} fa-lock text-red"></span> @lang('forum.closed')
                                                        @endif
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="type" class="mt-5 col-sm-1 label label-default fatten-me">@lang('forum.activity')</label>
                                            <div class="col-sm-10">
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('subscribed',$params) && $params['subscribed'] == 1)
                                                            <input type="checkbox" value="1" name="subscribed" checked> <span class="{{ config('other.font-awesome') }} fa-bell text-green"></span> @lang('forum.subscribed')
                                                        @else
                                                            <input type="checkbox" value="1" name="subscribed"> <span class="{{ config('other.font-awesome') }} fa-bell text-green"></span> @lang('forum.subscribed')
                                                        @endif
                                                    </label>
                                                </span>
                                                <span class="badge-user">
                                                    <label class="inline">
                                                        @if(isset($params) && is_array($params) && array_key_exists('notsubscribed',$params) && $params['notsubscribed'] == 1)
                                                            <input type="checkbox" value="1" name="notsubscribed" checked> <span class="{{ config('other.font-awesome') }} fa-bell-slash text-red"></span> @lang('forum.not-subscribed')
                                                        @else
                                                            <input type="checkbox" value="1" name="notsubscribed"> <span class="{{ config('other.font-awesome') }} fa-bell-slash text-red"></span> @lang('forum.not-subscribed')
                                                        @endif
                                                    </label>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="sort" class="mt-5 col-sm-1 label label-default fatten-me">Ordenar</label>
                                            <div class="col-sm-2">
                                                <label for="sorting"></label><select id="sorting" name="sorting" class="form-control">
                                                    <option value="updated_at" {{ (isset($params) && is_array($params) && array_key_exists('sorting',$params) && $params['sorting'] == 'updated_at' ? 'SELECTED' : '') }}>Updated At</option>
                                                    <option value="created_at" {{ (isset($params) && is_array($params) && array_key_exists('sorting',$params) && $params['sorting'] == 'created_at' ? 'SELECTED' : '') }}>Created At</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mx-0 mt-5 form-group fatten-me">
                                            <label for="sort" class="mt-5 col-sm-1 label label-default fatten-me">Direção</label>
                                            <div class="col-sm-2">
                                                <label for="direction"></label><select id="direction" name="direction" class="form-control">
                                                    <option value="desc"{{ (isset($params) && is_array($params) && array_key_exists('direction',$params) && $params['direction'] == 'desc' ? 'SELECTED' : '') }}>Decrescente</option>
                                                    <option value="asc"{{ (isset($params) && is_array($params) && array_key_exists('direction',$params) && $params['direction'] == 'asc' ? 'SELECTED' : '') }}>Acrescente</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="button-holder" style="margin-top: 20px !important;">
                                            <div class="button-center">
                                                <button type="submit" class="btn btn-primary">Atualizar resultados</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Fórum</th>
                        <th>Tópico</th>
                        <th>Autor</th>
                        <th>Stats</th>
                        <th>Última Informação</th>
                    </tr>
                </thead>

                <tbody>
                @foreach ($results as $r)
                    <tr>
                        <td class="f-display-topic-icon">
                            <span class="badge-extra text-bold">{{ $r->topic->forum->name }}</span>
                        </td>
                        <td class="f-display-topic-title">
                            <strong>
                                <a href="{{ route('forum_topic', ['id' => $r->topic->id, 'slug' => $r->topic->slug]) }}">{{ $r->topic->name }}</a>
                            </strong>
                            @if ($r->topic->is_closed == true)
                                <span class='label label-sm label-default'>Fechadas</span>
                            @endif
                            @if ($r->topic->is_pinned == true)
                                <span class='label label-sm label-success'>Pin</span>
                            @endif
                        </td>
                        <td class="f-display-topic-started">
                            <a href="{{ route('user.profile', ['slug' => Str::slug($r->topic->first_post_user_name)]) }}">{{ $r->topic->first_post_user_name }}</a>
                        </td>
                        <td class="f-display-topic-stats">
                            {{ $r->topic->num_post - 1 }} Respostas / {{ $r->topic->views }} Views
                        </td>
                        <td class="f-display-topic-last-post">
                            <a href="{{ route('user.profile', ['slug' => Str::slug($r->topic->last_post_user_name)]) }}">{{ $r->topic->last_post_user_name }}</a>,
                            <time datetime="{{ date('d-m-Y h:m', strtotime($r->topic->updated_at)) }}">
                                {{ date('M d Y', strtotime($r->topic->updated_at)) }}
                            </time>
                        </td>
                    </tr>
                    @if(isset($params) && is_array($params) && array_key_exists('body', $params))
                        <tr>
                            <td colspan="5" class="some-padding button-padding">
                                <div class="topic-posts button-padding">
                                    <div class="post" id="post-{{$r->id}}">
                                        <div class="button-holder">
                                            <div class="button-left">
                                                <a href="{{ route('user.profile', ['slug' => $r->user->slug]) }}" class="post-info-name" style="color:{{ $r->user->role->color }}; display:inline;">
                                                    {{ $r->user->name }}
                                                </a>
                                                @ {{ date('M d Y h:i:s', $r->created_at->getTimestamp()) }}
                                            </div>
                                            <div class="button-right">
                                                <a class="text-bold" href="{{ route('forum_topic', ['id' => $r->topic->id, 'slug' => $r->topic->slug]) }}?page={{$r->getPageNumber()}}#post-{{$r->id}}">#{{$r->id}}</a>
                                            </div>
                                        </div>
                                        <hr class="some-margin">
                                        {!! $r->getContentHtml() !!}
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center col-md-12">
            {{ $results->links() }}
        </div>
    </div>

@endsection
