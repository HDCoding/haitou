@extends('layouts.dashboard')

@section('title', $torrent->name)

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
                            <li class="breadcrumb-item"><a href="{{ url('torrents') }}">Torrents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $torrent->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if(!empty($torrent->media->cover))
                <div class="col-sm-12 col-lg-12">
                    <div class="card vegas-fixed-background" id="media-cover">
                        <div class="card-body py-5 my-5">
                            <h4 class="text-center text-dark">{{ $torrent->media->name }}</h4>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12">
                @includeIf('errors.errors', [$errors])
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title m-b-30">{{ $torrent->name }}</h3>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <div class="white-box text-center">
                                    <img class="img-responsive" src="{{ $torrent->media->poster }}" alt="Poster">
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                @if(auth()->user()->can('download-torrent'))
                                    <a href="{{ route('torrent.download', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Download" data-original-title="Download">
                                        <button type="button" class="btn icon-btn btn-success">
                                            <span class="oi oi-cloud-download"></span>
                                        </button>
                                    </a>
                                @endif
                                @if($torrent->seeders < 2 AND $torrent->create_at > now()->addDays(7))
                                    <a href="{{ route('torrent.reseed', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Pedir Re-Seed" data-original-title="Pedir Re-Seed">
                                        <button type="button" class="btn icon-btn btn-warning">
                                            <span class="fas fa-exclamation"></span>
                                        </button>
                                    </a>
                                @endif
                                <a href="{{ route('torrent.report', [$torrent->id]) }}" class="mr-2" data-toggle="tooltip" data-placement="top" title="Reportar Torrent" data-original-title="Reportar Torrent">
                                    <button type="button" class="btn icon-btn btn-dark">
                                        <span class="fas fa-flag"></span>
                                    </button>
                                </a>
                                <h4 class="box-title m-t-40">Descrição Mídia</h4>
                                {!! $torrent->media->descriptionHtml() !!}

                                <h4 class="box-title m-t-40">Descrição Torrent</h4>
                                {!! $torrent->descriptionHtml() !!}

                                @if(!$thanks)
                                    <h4 class="box-title m-t-40">Agradecer</h4>
                                    {!! Form::open(['route' => ['torrent.thanks', $torrent->id], 'class' => 'form-horizontal']) !!}
                                        <button type="submit" class="btn btn-danger btn-rounded" data-toggle="tooltip" title="" data-original-title="Obrigada(o)"><i class="ti-heart"></i> </button>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <h3 class="box-title m-t-40">Info</h3>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>Mídia:</td>
                                            <td>{{ link_to_route('media.show', $torrent->media->name, [$torrent->media->id, $torrent->media->slug]) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Uploader:</td>
                                            <td>{!! $torrent->uploader() !!}</td>
                                        </tr>
                                        <tr>
                                            <td>Categoria:</td>
                                            <td>{{ $torrent->category->name }}</td>
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
                                            <td>{{ $torrent->size() }}</td>
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
                                                <div class="row">
                                                    {!! $torrent->freeleech() !!}
                                                    {!! $torrent->silver() !!}
                                                    {!! $torrent->doubleUp() !!}
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><i class="fa fa-users text-muted "></i> Agradecimentos</td>
                                            <td>({{ $total }})</td>
                                        </tr>
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
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#nav-comments" role="tab" aria-controls="pills-profile" aria-selected="true">Comentários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#nav-files" role="tab" aria-controls="pills-setting" aria-selected="false">Arquivos</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="nav-comments" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Comentários Recentes</h4>
                                </div>
                                <br>
                                @include('includes.comments')
                                <br>
                                <hr>
                                @if(auth()->user()->can('comentar-fansubs') OR $torrent->allow_comments == true)
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
                                        {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-rounded']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                @else
                                <p class="text-center font-weight-bold text-danger">Sua permissão de fazer comentários em torrents foram revogadas <strong class="text-info">OU</strong> comentários para este torrent foram desativadas</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-files" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-borderless">
                                        <thead>
                                        <tr>
                                            <th colspan="2">Arquivos</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($torrent->files as $files)
                                            <tr>
                                                <td>{{ $files->name }}</td>
                                                <td>{!! $files->fileSize() !!}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
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

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '');
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

    @if(!empty($torrent->media->cover))
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
    @endif

@endsection
