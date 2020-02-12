@extends('layouts.dashboard')

@section('title', 'Meus Posts')

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
                            <li class="breadcrumb-item active" aria-current="page">Meus Posts</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('site.forums.buttons')
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Meus Posts</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Stats</th>
                                    <th>Data</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    @if ($post->topic->viewable())
                                    <tr>
                                        <th>
                                            <a class="font-weight-bold" href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}?page={{ $post->pageNumber() }}#post-{{ $post->id }}">#{{ $post->id }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('forum.topics', [$post->forum->id, $post->forum->slug]) }}">{{ $post->forum->name }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}">{{ $post->topic->name }}</a>
                                            @if ($post->topic->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($post->topic->is_pinned)
                                                <span class="badge badge-success">Pinned</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $post->count() - 1 }} Respostas / {{ $post->topic->views }} Views
                                        </td>
                                        <td>
                                            @if($post->updated_at && $post->updated_at != null)
                                                <time datetime="{{ format_date_time($post->updated_at) }}">
                                                    {{ format_date_time($post->updated_at) }}
                                                </time>
                                            @else
                                                <time datetime="N/A">N/A</time>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5">
                                            <div class="post" id="post-{{ $post->id }}">
                                                {!! $post->contentHtml() !!}
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
