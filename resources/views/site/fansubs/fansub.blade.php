@extends('layouts.dashboard')

@section('subtitle', $fansub->name)

@section('content')

    <div class="py-3 mb-4 h4">
        <ol class="breadcrumb font-weight-bold m-0">
            <li class="breadcrumb-item"><a href="{{ url('fansubs') }}">Fansubs</a></li>
            <li class="breadcrumb-item active">{{ $fansub->name }}</li>
        </ol>
    </div>

    <!-- Header -->
    <div class="border-right-0 border-left-0 ui-bordered container-m--x mb-4">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-9">
                <div class="media-body container-p-x py-4">

                </div>
            </div>
            <div class="col-md-3">
                <div class="container-p-x py-4">
                    <div class="text-muted small">Status</div>
                    {!! $fansub->status() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Header -->

    <div class="row">
        <div class="col">

            <!-- Description -->
            <div class="card mb-4">
                <h6 class="card-header">Descrição</h6>
                <div class="card-body">
                    {!! $fansub->descriptionHtml() !!}
                </div>
            </div>
            <!-- / Description -->

            <!-- Comentários -->
            <div class="block mt-5">
                <div class="nav-tabs-top mb-4">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#nav-comments">
                                <i class="fa fa-comment text-info"></i> Comentários
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="nav-comments">
                            @include('layouts.includes.comment_layout')
                        </div>
                    </div>
                </div>
            </div>

            @if(auth()->user()->permission->fansubs_comment)
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                    {!! Form::hidden('fansub_id', $fansub->id) !!}
                    <div class="form-group">
                        {!! Form::label('content', 'Comentário: *') !!}
                        {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                    </div>
                    {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
                    <br>
                    {!! Form::close() !!}
                </div>
            </div>
            @else
                <p class="text-center font-weight-bold">Sua permissão de fazer comentários em Fansubs foram revogadas!!</p>
            @endif
            <!-- / Comentários -->
        </div>
        <div class="col-md-4 col-xl-3">

            <!-- Details -->
            <div class="card mb-4">
                <h6 class="card-header with-elements">
                    <span class="card-header-title">Info</span>
                    @if($fansub->fansub_mod($fansub->id))
                        <div class="card-header-elements ml-auto">
                            <a href="{{ url('staff/fansubs/' . $fansub->id . '/edit') }}" class="btn btn-xs btn-outline-success">
                                <span class="ion ion-ios-link"></span> Editar
                            </a>
                        </div>
                    @endif
                </h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Website</div>
                        <div><a href="{{ $fansub->website }}">{{ $fansub->name }}</a></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">Discord</div>
                        <div><a href="{{ $fansub->discord }}">Discord</a></div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">IRC Server</div>
                        <div>{{ $fansub->irc_server }}</div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="text-muted">IRC Channel</div>
                        <div>{{ $fansub->irc_channel }}</div>
                    </li>
                </ul>
            </div>
            <!-- / Details -->

            <!-- Participants -->
            <div class="card mb-4">
                <h6 class="card-header with-elements">
                    <span class="card-header-title">Membros</span>
                    @if($fansub->fansub_mod($fansub->id))
                    <div class="card-header-elements ml-auto">
                        <a href="{{ url('staff/fansub/' . $fansub->id . '/members') }}" class="btn btn-xs btn-outline-primary">
                            <span class="ion ion-md-add"></span> Adicionar
                        </a>
                    </div>
                    @endif
                </h6>
                <ul class="list-group list-group-flush">
                    @foreach($members as $member)
                        <li class="list-group-item">
                            <div class="media align-items-center">
                                <img src="{{ $member->user->getAvatar() }}" class="d-block ui-w-30 rounded-circle"
                                     alt="Avatar">
                                <div class="media-body px-2">
                                    <a href="{{ route('user.profile', ['slug' => $member->slug]) }}" class="text-dark">{{ $member->user->name }}</a>
                                    <span class="badge badge-outline-success ml-2">{{ $member->job }}</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- / Participants -->

        </div>
    </div>

@endsection

@section('script')

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                var page = window.location.hash.replace('#', '');
                if (page === Number.NaN || page <= 0) {
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
                alert('Nenhuma resposta do servidor');
            });
        }
    </script>

@endsection
