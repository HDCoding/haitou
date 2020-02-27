@extends('layouts.dashboard')

@section('title', 'Fórum')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Fórum</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if(setting('forum_on'))
                <div class="col-12 col-md-3 mb-3">
                    {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
                    {!! Form::hidden('sorting', 'created_at') !!}
                    {!! Form::hidden('direction', 'desc') !!}
                    {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisa rápida...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-12">
                @includeIf('errors.errors', [$errors])
                @include('includes.messages')

                @include('site.forums.buttons')

                @foreach($categories as $category)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ $category->name }}</h4>
                            <div class="table-responsive m-t-20">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Fórums</th>
                                        <th class="text-center" scope="col">Tópicos</th>
                                        <th class="text-center" scope="col">Posts</th>
                                        <th scope="col">Última Mensagem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($forums as $forum)
                                        @if($category->id === $forum->category_id)
                                            @if($forum->getPermission() != null && $forum->getPermission()->view_forum)
                                                <tr>
                                                    <th>
                                                        <div class="media">
                                                            <div class="mt-1">
                                                                <i class="{{ $forum->icon }} fa-2x mr-4"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <h5 class="media-heading">
                                                                    {{ link_to_route('forum.threads', $forum->name, ['forum_id' => $forum->id, 'slug' => $forum->slug], ['class' => 'h5 text-info']) }}
                                                                </h5>
                                                                <div class="text-dark">{{ $forum->description }}</div>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td class="align-middle text-center">{{ $forum->num_topic }}</td>
                                                    <td class="align-middle text-center">{{ $forum->num_post }}</td>

                                                    @if($forum->num_post > 0)
                                                    <td>
                                                        @if(!empty($forum->last_post_username))
                                                            <div class="ml-2">
                                                                {{ link_to_route('forum.topic', $forum->last_topic_name, ['topic_id' => $forum->last_topic_id, 'slug' => $forum->last_topic_slug]) }}
                                                                <div class="text-dark small text-truncate">
                                                                    {{ $forum->updated_at->diffForHumans() }}
                                                                    <span class="ml-1 mr-1">·</span>
                                                                    {{ link_to_route('user.profile', $forum->last_post_username, [strtolower($forum->last_post_username)], ['class' => 'text-info']) }}
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    @else
                                                    <td class="align-middle text-center">
                                                        <span class="last-wrapper text-overflow">Sem posts</span>
                                                    </td>
                                                    @endif
                                                </tr>
                                            @endif
                                        @endif
                                    @empty
                                        <tr class="card-body py-3">
                                            <td class="text-center" colspan="4">Nenhum forum no momento.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                @endforeach
            @else
                <p class="text-center h4 font-weight-bold">Fórum fechado para manutenção no momento.</p>
            @endif
            </div>
        </div>
    </div>

@endsection
