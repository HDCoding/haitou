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
            <div class="col-12 col-md-3 mb-3">
                {!! Form::open(['route' => 'forum.search', 'method' => 'GET']) !!}
                {!! Form::hidden('sorting', 'created_at') !!}
                {!! Form::hidden('direction', 'desc') !!}
                {!! Form::text('name', (isset($params) && is_array($params) && array_key_exists('name', $params) ? $params['name'] : ''), ['class' => 'form-control', 'placeholder' => 'Pesquisar...', 'required', 'minlength' => 3, 'maxlengt' => 30]) !!}
                {!! Form::close() !!}
            </div>
            <div class="col-12">
                @includeIf('errors.errors', [$errors])

{{--                @if(setting('forum_on'))--}}

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
                                            <th scope="col">Tópicos</th>
                                            <th scope="col">Último Tópico</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($category->forums as $forum)
                                            @if($forum->getPermission() != null && $forum->getPermission()->view_forum)
                                                <tr>
                                                    <th scope="row">
                                                        <i class="fas fa-file-alt fa-2x mr-4"></i>
                                                        <a class="h5 text-info" href="{{ route('forum.topics', [$forum->id, $forum->slug]) }}">{{ $forum->name }}</a>
                                                        <div class="text-muted small ml-5">{{ $forum->description }}</div>
                                                    </th>
                                                    <td>{{ $forum->topics->count() }}</td>
                                                    <td>
                                                        @if($forum->posts->count() > 0)
                                                            @if(empty($forum->topics->last()->last_post_username))
                                                                <div class="ml-2">
                                                                    <a class="d-block text-truncate" href="{{ route('forum.topic', [$forum->topics->last()->id, $forum->topics->last()->slug]) }}">
                                                                        {{ $forum->topics->last()->name }}
                                                                    </a>
                                                                    <div class="text-muted small text-truncate">
                                                                        {{ format_date_time($forum->topics->last()->updated_at) }}
                                                                        &nbsp;·&nbsp;
                                                                        <a class="text-info" href="{{ route('user.profile', [strtolower($forum->topics->last()->first_post_username)]) }}">
                                                                            {{ $forum->topics->last()->first_post_username }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="ml-2">
                                                                    <a class="d-block text-truncate" href="{{ route('forum.topic', [$forum->topics->last()->id, $forum->topics->last()->slug]) }}">
                                                                        {{ $forum->topics->last()->name }}
                                                                    </a>
                                                                    <div class="text-muted small text-truncate">
                                                                        {{ format_date_time($forum->topics->last()->updated_at) }}
                                                                        &nbsp;·&nbsp;
                                                                        <a class="text-info" href="{{ route('user.profile', [strtolower($forum->topics->last()->last_post_username)]) }}">
                                                                            {{ $forum->topics->last()->last_post_username }}
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <span class="last-wrapper text-overflow">Sem posts</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr class="card-body py-3">
                                                <td class="text-center" colspan="3">Nenhum forum no momento.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    @endforeach
{{--                @else--}}
{{--                    <p class="text-center"><b>Forúm fechado para manutenção momento.</b></p>--}}
{{--                @endif--}}
            </div>
        </div>
    </div>

@endsection
