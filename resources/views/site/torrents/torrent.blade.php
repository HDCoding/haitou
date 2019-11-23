@extends('layouts.dashboard')

@section('subtitle', $torrent->name)

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="demo-vertical-spacing mb-4">
        <div id="media-cover" class="vegas-fixed-background">
            <h3 class="text-center text-white py-4 my-5">{{ $torrent->media->name }}</h3>
        </div>
    </div>

    <div class="block">

        <div class="row">
            <div class="col-md-4">
                <!-- poster -->
                <div class="block block-rounded">
                    <img class="img-fluid" src="{{ $torrent->media->poster }}" alt="{{ $torrent->media->name }}">
                </div>
                <!-- END poster -->
            </div>
            <div class="col-md-8">
                <!-- description -->
                <div class="block block-rounded">
                    <div class="block-content">
                        @includeIf('errors.errors', [$errors])
                        <table class="table table-striped table-borderless remove-margin-b">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        @if(auth()->user()->permission->torrents_download)
                                        <a href="{{ route('torrent.download', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Download" data-original-title="Download">
                                            <button type="button" class="btn icon-btn btn-outline-success">
                                                <span class="oi oi-cloud-download"></span>
                                            </button>
                                        </a>
                                        @endif
                                        @if($torrent->seeders < 2)
                                            <a href="{{ route('torrent.reseed', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Pedir Re-Seed" data-original-title="Pedir Re-Seed">
                                                <button type="button" class="btn icon-btn btn-outline-warning">
                                                    <span class="fas fa-exclamation"></span>
                                                </button>
                                            </a>
                                        @endif
                                        <a href="{{ route('torrent.report', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Reportar Torrent" data-original-title="Reportar Torrent">
                                            <button type="button" class="btn icon-btn btn-outline-dark">
                                                <span class="fas fa-flag"></span>
                                            </button>
                                        </a>
                                        {{ $torrent->name }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Mídia:</td>
                                <td>{{ link_to_route('media.show', $torrent->media->name, [$torrent->media->id, $torrent->media->slug]) }}</td>
                            </tr>
                            <tr>
                                <td style="width: 20%;">Uploader:</td>
                                <td>{!! $torrent->getUploader() !!}</td>
                            </tr>
                            <tr>
                                <td>Categoria:</td>
                                <td>
                                    {{ $torrent->category->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>Fansub:</td>
                                <td>
                                    <a href="{{ route('fansub.show', [$torrent->fansub->id, $torrent->fansub->slug]) }}">{{ $torrent->fansub->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Hash:</td>
                                <td>{{ $torrent->info_hash }}</td>
                            </tr>
                            <tr>
                                <td>Tamanho:</td>
                                <td>{{ $torrent->getSize() }}</td>
                            </tr>
                            <tr>
                                <td>Status:</td>
                                <td>
                                    <i class="fa fa-arrow-up text-success" title="Seeders"></i> {{ $torrent->seeders }} &nbsp;
                                    <i class="fa fa-arrow-down text-danger" title="Leechers"></i> {{ $torrent->leechers }} &nbsp;
                                    <i class="fa fa-check text-info" title="Completado"></i> {{ $torrent->times_completed }}
                                </td>
                            </tr>
                            <tr>
                                <td>Upload em:</td>
                                <td>{{ $torrent->created_at->format('d/m/Y') }}</td>
                            </tr>
                            <tr>
                                <td>Total de arquivos:</td>
                                <td>{{ $torrent->num_files }}</td>
                            </tr>
                            <tr>
                                <td>Bônus</td>
                                <td>
                                    <p class="nice-copy">
                                        {!! $torrent->getFreeleech() !!}
                                        {!! $torrent->getSilver() !!}
                                        {!! $torrent->getDoubleUp() !!}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Descrição:</b> {!! $torrent->descriptionHtml() !!}</td>
                            </tr>
                            </tbody>
                        </table>
                        <table class="table table-borderless remove-margin-b">
                            <thead>
                                <tr>
                                    <th colspan="2">Agradecer</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!$thanks)
                                <tr>
                                    <td colspan="2">
                                        {!! Form::open(['route' => ['torrent.thanks', $torrent->id], 'class' => 'form-horizontal']) !!}
                                        {!! Form::submit('Obrigada(o)', ['class' => 'btn  btn-primary btn-rounded btn-outline']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td><i class="fa fa-users text-muted "></i> Agradecimentos</td>
                                <td>({{ $total }})</td>
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
                    <a class="nav-link active" data-toggle="tab" href="#nav-comments"><i class="fa fa-comment text-info"></i> Comentários</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#nav-files"><i class="fa fa-folder text-warning"></i> Arquivos</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="nav-comments">
                    @include('layouts.includes.comment_layout')
                </div>
                <div class="tab-pane fade" id="nav-files">
                    <div class="card-body">
                        <table class="table table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th colspan="2">Arquivos</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($torrent->torrent_files as $files)
                                <tr>
                                    <td>{{ $files->name }}</td>
                                    <td>{!! $files->getFileSize() !!}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($torrent->allow_comments AND auth()->user()->permission->torrents_comment)
        <div class="card">
            <div class="card-body">

                {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                {!! Form::hidden('torrent_id', $torrent->id) !!}
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
                {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
                <br>
                {!! Form::close() !!}

            </div>
        </div>
    @else
        <p class="text-center font-weight-bold">Sua permissão de fazer comentários em torrents foram revogadas <strong class="text-info">OU</strong> comentários para este torrent foram desativadas</p>
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
                    { src: "{{ $torrent->media->cover }}" },
                ],
                transition: [ 'fade', 'zoomOut', 'zoomIn', 'blur' ],
                animation: [ 'kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight' ]
            });
        });
    </script>

@endsection
