@extends('layouts.dashboard')

@section('title', 'Meus Tópicos')

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
                            <li class="breadcrumb-item active" aria-current="page">Meus Tópicos</li>
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
                        <h4 class="card-title">Meus Tópicos</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Stats</th>
                                    <th>Última Mensagem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topics as $topic)
                                    @if ($topic->viewable())
                                    <tr>
                                        <th>
                                             <a href="{{ route('forum.topics', [$topic->forum->id, $topic->forum->slug]) }}">{{ $topic->forum->name }}</a>
                                        </th>
                                        <td>
                                            <a href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">{{ $topic->name }}</a>
                                            @if ($topic->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($topic->is_pinned)
                                                <span class="badge badge-success">Pinned</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $topic->posts->count() - 1 }} Respostas / {{ $topic->views }} Views
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($topic->last_post_username)]) }}">
                                                {{ $topic->last_post_username }}
                                            </a>,
                                            @if($topic->updated_at && $topic->updated_at != null)
                                                <time datetime="{{ format_date_time($topic->updated_at) }}">
                                                    {{ format_date_time($topic->updated_at) }}
                                                </time>
                                            @else
                                                <time datetime="N/A">N/A</time>
                                            @endif
                                        </td>
                                    </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            {{ $topics->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
