@extends('layouts.dashboard')

@section('subtitle', $media->name)

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="demo-vertical-spacing mb-4">
        <div id="media-cover" class="vegas-fixed-background">
            <h3 class="text-center text-white py-4 my-5">{{ $media->name }}</h3>
        </div>
    </div>

    <div class="block">
        <div class="row">
            <div class="col-md-4">
                <!-- logo -->
                <div class="block block-rounded">
                    <img class="img-fluid" src="{{ $media->poster }}" alt="Poster">
                </div>
                <!-- END logo -->

                <!-- Sobre -->
                <div class="block block-rounded">
                    <div class="block-header bg-gray-lighter text-center">
                        <h3 class="block-title">{{ $media->name }}</h3>
                    </div>
                    <div class="block-content">
                        <table class="table table-striped">
                            <tr>
                                <td>
                                    @if($bookmarked)
                                        {!! Form::open(['route' => ['delete.bookmark', $bookmarked->id], 'method' => 'DELETE', 'class' => 'form-horizontal']) !!}
                                        <button type="submit" class="btn icon-btn btn-outline-dark" data-toggle="tooltip" data-placement="top" title="Remover dos favoritos" data-original-title="Remover dos favoritos">
                                            <span class="fas fa-heartbeat"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::open(['route' => ['save.bookmark'], 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('media_id', $media->id) !!}
                                        <button type="submit" class="btn icon-btn btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Adicionar aos favoritos" data-original-title="Adicionar aos favoritos">
                                            <span class="oi oi-heart"></span>
                                        </button>
                                        {!! Form::close() !!}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-2x fa-star push-10-r text-warning"></i> Total de votos: {{ $media->getTotalRating() }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    @if($voted != null)
                                        <i class="fa fa-fw fa-2x fa-star push-10-r text-warning" data-toggle="tooltip" data-placement="top" title="" data-original-title="Seu Voto"></i>Seu Voto: {{ $voted->vote }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row items-push-2x">

                                        <div class="col-sm-2">
                                            <!-- Resultado -->
                                            <h3 class="font-w700">{{ $media->getAvgRating() }}</h3>
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
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <!-- description -->
                @includeIf('errors.errors', [$errors])
                <div class="block block-rounded">
                    <div class="block-content">
                        <table class="table table-striped table-borderless remove-margin-b">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ $media->name }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 20%;">Categoria:</td>
                                    <td>{{ $media->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Estúdio:</td>
                                    <td>
                                        <a href="{{ route('studio.show', [$media->studio->id, $media->studio->slug]) }}">
                                            {{ $media->studio->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Título:</td>
                                    <td>{{ $media->name }}</td>
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
                                    <td>{!! $media->getGenre() !!}</td>
                                </tr>
                                <tr>
                                    <td>Lançamento:</td>
                                    <td>{{ $media->released_at->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <td>Última exibição:</td>
                                    <td>
                                        {{ !empty($media->finished_at) ? $media->finished_at->format('d/m/Y') : 'Em exibição' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>+18:</td>
                                    <td>{{ $media->adult ? 'Sim' : 'Não' }}</td>
                                </tr>
                                <tr>
                                    <td>Status:</td>
                                    <td>{!! $media->getStatus() !!}</td>
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
                                <tr>
                                    <td>Gêneros:</td>
                                    <td>
                                        @foreach($media->genres as $genre)
                                            <span class="badge badge-outline-info mr-2">{{ $genre->name }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Descrição:</b> {!! $media->descriptionHtml() !!}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
                <!-- END description -->
            </div>
        </div>
    </div>

    <div class="block mt-5">
        <div class="nav-tabs-top mb-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#nav-casts"><i class="fa fa-users text-dark"></i> Elenco</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-comments"><i class="fa fa-comment text-info"></i> Comentários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-trailer"><i class="fas fa-tv text-success"></i> Trailer</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="nav-casts">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($media->media_casts as $cast)
                            <tr>
                                @if($cast->actor != null)
                                    <th>
                                        <img class="img-avatar rounded" src="{{ $cast->actor->image }}" alt="{{ $cast->actor->name }}" style="width:60px; height:60px;">
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

                <div class="tab-pane fade" id="nav-comments">
                    @include('layouts.includes.comment_layout')
                </div>
                <div class="tab-pane fade" id="nav-trailer">
                    <div class="card-body">
                        @if(!empty($media->yt_video))
                            <div class="embed-responsive embed-responsive-16by9 push-30">
                                <iframe class="embed-responsive-item" type="text/html" src="{{ $media->getTrailer() }}" allowfullscreen></iframe>
                            </div>
                        @else
                            <p class="text-center push-30">Nenhum trailer cadastrado no momento.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    @if(auth()->user()->permission->medias_comment)
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('media_id', $media->id) !!}
            <div class="form-group">
                {!! Form::label('content', 'Comentário: *') !!}
                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
            </div>
            <div class="form-group">
                <label class="custom-control custom-checkbox">
                    {!! Form::checkbox('is_spoiler', true, false, ['class' => 'custom-control-input']) !!}
                    <span class="custom-control-label">Spoiler?</span>
                </label>
            </div>
            {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
            <br>
            {!! Form::close() !!}
        </div>
    </div>
    @else
        <p class="text-center font-weight-bold">Sua permissão de fazer comentários em Mídias foram revogadas!!</p>
    @endif
    <!-- / Comentários -->

@endsection

@section('script')
    <!-- RatingJS -->
    <script src="{{ asset('vendor/jquery-raty/jquery.raty.js') }}"></script>
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>
    <script src="{{ asset('js/pages/base_comp_rating.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $('#vote').on('change', function(e){
            $(this).closest('form').submit();
        });
    </script>

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

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            // Fixed bg
            $('#media-cover').vegas({
                overlay: false,
                timer: false,
                shuffle: true,
                slides: [
                    { src: "{{ $media->cover }}" },
                ],
                transition: [ 'fade', 'zoomOut', 'zoomIn', 'blur' ],
                animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
            });
        });
    </script>

@endsection
