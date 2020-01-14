@extends('layouts.dashboard')

@section('title', $media->name)

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $media->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if(!empty($media->cover()))
            <div class="col-sm-12 col-lg-12">
                <div class="card vegas-fixed-background" id="media-cover">
                    <div class="card-body py-5 my-5">
                        <h4 class="text-center text-dark">{{ $media->name }}</h4>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-12">
                @includeIf('errors.errors', [$errors])
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-30">{{ $media->name }}</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="white-box text-center">
                                    <img class="img-fluid img-responsive" src="{{ $media->poster }}" alt="Poster" width="300px">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title m-t-40">Descrição</h4>
                                <p>{!! $media->descriptionHtml() !!}</p>
                                <h5 class="m-t-40">Favoritos</h5>
                                @if($bookmarked)
                                    {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                    <button type="submit" class="btn icon-btn btn-dark" data-toggle="tooltip" title="Remover dos favoritos" data-original-title="Remover dos favoritos">
                                        <i class="fas fa-heartbeat"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @else
                                    {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                    {!! Form::hidden('media_id', $media->id) !!}
                                    <button type="submit" class="btn icon-btn btn-danger" data-toggle="tooltip" title="Adicionar aos favoritos" data-original-title="Adicionar aos favoritos">
                                        <i class="oi oi-heart"></i>
                                    </button>
                                    {!! Form::close() !!}
                                @endif
                                <h5 class="m-t-40">Votos</h5>
                                <i class="fa fa-fw fa-2x fa-star push-10-r text-warning"></i> Total de votos: {{ $media->totalRating() }}
                                @if($voted != null)
                                    <i class="fa fa-fw fa-2x fa-star push-10-r text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Seu Voto"></i>Seu Voto: {{ $voted->vote }}
                                @endif
                                <div class="col-sm-2">
                                    <!-- Resultado -->
                                    <h3 class="font-w700">{{ $media->avgRating() }}</h3>
                                </div>
                                <div class="col-sm-2">
                                    {!! Form::open(['route' => ['media.vote', $media->id], 'class' => 'form-horizontal']) !!}
                                    <label for="vote"></label>
                                    <select name="vote" id="vote">
                                        <option value="">--</option>
                                        @for($i = 0; $i <= 10; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                    {!! Form::close() !!}
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 class="box-title m-t-40">Info</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Categoria</td>
                                            <td>{{ $media->category->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Estúdio</td>
                                            <td>
                                                <a href="{{ route('studio.show', [$media->studio->id, $media->studio->slug]) }}">
                                                    {{ $media->studio->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        @if(!empty($media->title_english))
                                            <tr>
                                                <td>Título inglês:</td>
                                                <td>{{ $media->title_english }}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($media->title_japanese))
                                            <tr>
                                                <td>Título Japonês:</td>
                                                <td>{{ $media->title_japanese }}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td>Tipo:</td>
                                            <td>{!! $media->genre() !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Lançamento:</td>
                                            <td>{{ format_date($media->released_at) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Última exibição:</td>
                                            <td>
                                                {{ !empty($media->finished_at) ? format_date($media->finished_at) : 'Em exibição' }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>+18:</td>
                                            <td>{{ $media->adult ? 'Sim' : 'Não' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Status:</td>
                                            <td>{!! $media->status() !!}</td>
                                        </tr>
                                        @if(!empty($media->total_episodes))
                                            <tr>
                                                <td>Episodios:</td>
                                                <td>{{ $media->total_episodes }}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($media->duration))
                                            <tr>
                                                <td>Duração:</td>
                                                <td>{{ $media->duration }} min.</td>
                                            </tr>
                                        @endif
                                        @if(!empty($media->total_chapters))
                                            <tr>
                                                <td>Capítulos:</td>
                                                <td>{{ $media->total_chapters }}</td>
                                            </tr>
                                        @endif
                                        @if(!empty($media->total_volumes))
                                            <tr>
                                                <td>Volumes:</td>
                                                <td>{{ $media->total_volumes }}</td>
                                            </tr>
                                        @endif
                                        <td>Gêneros:</td>
                                        <td>
                                            @foreach($media->genres as $genre)
                                                <span class="badge badge-pill badge-info m-r-5">{{ $genre->name }}</span>
                                            @endforeach
                                        </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xlg-12 col-md-12">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#nav-cast" role="tab" aria-controls="pills-timeline" aria-selected="true">Elenco</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#nav-comments" role="tab" aria-controls="pills-profile" aria-selected="false">Comentários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#nav-trailer" role="tab" aria-controls="pills-setting" aria-selected="false">Trailer</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="nav-cast" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <table class="table">
                                    <thead>

                                    </thead>
                                    <tbody>
                                    @foreach($media->media_casts as $cast)
                                        <tr>
                                            @if($cast->actor != null)
                                                <th>
                                                    <img class="img rounded" src="{{ $cast->actor->image }}" alt="{{ $cast->actor->name }}" style="width:60px; height:60px;">
                                                </th>
                                                <td class="align-middle text-left">
                                                    <a href="{{ route('actors.show', [$cast->actor->id, $cast->actor->slug]) }}">
                                                        {{ $cast->actor->name }}
                                                    </a>
                                                </td>
                                            @endif
                                            @if($cast->character != null)
                                                <td class="align-middle text-right">
                                                    <a href="{{ route('characters.show', [$cast->character->id, $cast->character->slug]) }}">
                                                        {{ $cast->character->name }}
                                                    </a>
                                                </td>
                                                <td class="text-right">
                                                    <img class="img-avatar rounded" src="{{ $cast->character->image }}" alt="{{ $cast->character->name }}" style="width:60px; height:60px;">
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-comments" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Comentários Recentes</h4>
                                </div>
                                <br>
                                @include('includes.comments')
                                <br>
                                <hr>
                                @if(auth()->user()->can('comentar-midias'))
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('media_id', $media->id) !!}
                                        <div class="form-group">
                                            {!! Form::label('content', 'Comentário: *') !!}
                                            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                        <div class="form-group">
                                            <label class="custom-control custom-checkbox">
                                                {!! Form::checkbox('is_spoiler', true, false, ['class' => 'custom-control-input']) !!}
                                                <span class="custom-control-label">Spoiler?</span>
                                            </label>
                                        </div>
                                        {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-rounded']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                @else
                                <p class="text-center font-weight-bold text-danger">Sua permissão de fazer comentários em Mídias foram revogadas!!</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-trailer" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <h4 class="card-title">Trailer</h4>
                                @if(!empty($media->yt_video))
                                    <div class="bd-example">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="{{ $media->trailer() }}" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                        </div>
                                    </div>
                                @else
                                    <p class="text-center push-30">Nenhum trailer cadastrado no momento.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>

    @if(!empty($media->cover()))
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            // Fixed bg
            $('#media-cover').vegas({
                overlay: false,
                timer: false,
                shuffle: true,
                slides: [
                    { src: "{{ $media->cover() }}" },
                ],
                transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
            });
        });
    </script>
    @endif

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                } else {
                    getData(page);
                }
            }
        });

        $(document).ready(function () {
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                $('li').removeClass('active');
                $(this).parent('li').addClass('active');
                var myurl = $(this).attr('href');
                var page = $(this).attr('href').split('page=')[1];
                getData(page);
            });
        });

        function getData(page) {
            $.ajax({
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function (data) {
                $("#nav-comments").empty().html(data);
                location.hash = page;
            }).fail(function (jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }
    </script>

@endsection
