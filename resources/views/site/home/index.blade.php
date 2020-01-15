@extends('layouts.dashboard')

@section('title', 'Home')

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card vegas-fixed-background" id="home-cover">
                    <div class="card-body py-5 my-5">
{{--                        <h4 class="text-center text-dark">Texto</h4>--}}
                    </div>
                </div>
            </div>
        </div>

        <!-- News -->
        <div class="card">
            <div class="card-header">
                Últimas notícias
                <div class="card-actions">
                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                </div>
            </div>
            <div class="card-body collapse show">
                @forelse($news as $new)
                    <p class="card-text">
                        {{ link_to_route('read.news', $new->name, ['id' => $new->id, 'slug' => $new->slug]) }}
                        &nbsp;
                        {{ format_date($new->created_at) }}
                    </p>
                @empty
                    <p class="card-text">Nenhum conteúdo informativo no momento.</p>
                @endforelse
            </div>
        </div>
        <!-- End News -->

        <!-- Others -->
        <div class="row">
            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Últimos Tópicos</h4>
                        <table class="table v-middle">
                            <thead>
                            <tr>
                                <th class="border-top-0">Fórum</th>
                                <th class="border-top-0">Tópico</th>
                                <th class="border-top-0">Autor(a)</th>
                                <th class="border-top-0">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($topics as $topic)
                                @if($topic->viewable())
                                    <tr>
                                        <td>
                                            <a href="{{ route('forum.topics', ['id' => $topic->forum->id, 'slug' => $topic->slug]) }}">
                                                {{ $topic->forum->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">
                                                {{ $topic->name }}
                                            </a>
                                        </td>
                                        <td>{{ $topic->first_post_username }}</td>
                                        <td>{{ $topic->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Últimas Postagens</h4>
                        <table class="table v-middle">
                            <thead>
                            <tr>
                                <th class="border-top-0">Post</th>
                                <th class="border-top-0">Tópico</th>
                                <th class="border-top-0">Autor(a)</th>
                                <th class="border-top-0">Data</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $post)
                                @if ($post->topic->viewable())
                                    <tr>
                                        <td>
                                            <a href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}?page={{ $post->pageNumber() }}#post-{{ $post->id }}">{{ preg_replace('#\[[^\]]+\]#', '', str_limit(htmlspecialchars_decode($post->content), 40)) }}</a>
                                        </td>
                                        <td>{{ $post->topic->name }}</td>
                                        <td>{{ $post->post_username }}</td>
                                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Últimas Pesquisas</h4>
                        <table class="table v-middle">
                            <thead>
                            <tr>
                                <th class="border-top-0">Pergunta</th>
                                <th class="border-top-0">Votos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($polls as $poll)
                                <td>{{ link_to_route('site.poll.show', $poll->name, ['id' => $poll->id, 'slug' => $poll->slug]) }}</td>
                                <td>{{ $poll->totalVotes() }}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Others -->

    </div>

@endsection

@section('scripts')
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            // Fixed bg
            $('#home-cover').vegas({
                overlay: false,
                timer: false,
                shuffle: true,
                slides: [
                    { src: "{{ asset('images/home.jpg') }}" },
                ],
                transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
            });
        });
    </script>

@endsection
