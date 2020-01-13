@extends('layouts.dashboard')

@section('title', $fansub->name)

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Fansubs</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('fansubs') }}">Fansubs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $fansub->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        @includeIf('errors.errors', [$errors])
                        <center class="m-t-30"> <img src="{{ $fansub->logo }}" class="img-thumbnail" width="450" alt="Logo" />
                            <h4 class="card-title m-t-10 m-b-20">{{ $fansub->name }}</h4>
                            <div class="row text-center justify-content-md-center">
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">{{ $fansub->users->count() }}</font></a></div>
                                <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-folder"></i> <font class="font-medium">{{ $fansub->torrents->count() }}</font></a></div>
                            </div>
                        </center>
                    </div>
                    <div><hr></div>
                    <div class="card-body">
                        <small class="text-muted">Status</small>
                        <h6>{!! $fansub->status() !!}</h6>
                    </div>
                    <div class="row text-center m-b-30">
                        @if($fansub->fansub_mod($fansub->id))
                            <div class="col-md-6">
                                <div class="ml-auto">
                                    <a href="{{ url('fansub/' . $fansub->id . '/edit') }}" class="btn btn-xs btn-success">
                                        <i class="ion ion-ios-link"></i> Editar
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="ml-auto">
                                    <a href="{{ url('fansub/' . $fansub->id . '/members') }}" class="btn btn-xs btn-primary">
                                        <i class="ion ion-md-add"></i> Adicionar/Editar Membros
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-timeline-tab" data-toggle="pill" href="#nav-description" role="tab" aria-controls="pills-timeline" aria-selected="true">Descrição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#nav-comments" role="tab" aria-controls="pills-profile" aria-selected="false">Comentários</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-setting-tab" data-toggle="pill" href="#nav-members" role="tab" aria-controls="pills-setting" aria-selected="false">Membros</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Website</strong>
                                        <br>
                                        @if(!empty($fansub->website))
                                        <a class="text-info" href="{{ hideref($fansub->website) }}" target="_blank">{{ $fansub->name }}</a>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Discord</strong>
                                        <br>
                                        @if(!empty($fansub->discord))
                                        <a class="text-info" href="{{ $fansub->discord }}" target="_blank">Discord</a>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>IRC Server</strong>
                                        <br>
                                        @if(!empty($fansub->irc_server))
                                        <p class="text-muted">{{ $fansub->irc_server }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <strong>IRC Channel</strong>
                                        <br>
                                        @if(!empty($fansub->irc_channel))
                                        <p class="text-muted">{{ $fansub->irc_channel }}</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <p class="m-t-30">
                                    {!! $fansub->descriptionHtml() !!}
                                </p>
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
                                @if(auth()->user()->can('comentar-fansubs'))
                                    <div class="card">
                                        <div class="card-body">
                                            {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                            {!! Form::hidden('fansub_id', $fansub->id) !!}
                                            <div class="form-group">
                                                {!! Form::label('content', 'Comentário: *') !!}
                                                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                            {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-rounded']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @else
                                    <p class="text-center font-weight-bold text-danger">Sua permissão de fazer comentários em Fansubs foram revogadas!!</p>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-members" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle">
                                        <thead>
                                        <tr class="border-0">
                                            <th class="border-0">Membros</th>
                                            <th class="border-0"></th>
                                            <th class="border-0"></th>
                                            <th class="border-0"></th>
                                            <th class="border-0"></th>
                                            <th class="border-0"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($members->chunk(4) as $member)
                                        <tr>
                                            @foreach($member as $user)
                                            <td>
                                                <div class="d-flex no-block align-items-center">
                                                    <div class="m-r-10">
                                                        <img src="{{ $user->user->avatar() }}" alt="user" class="rounded-circle" width="45" />
                                                    </div>
                                                    <div class="">
                                                        <h5 class="m-b-0 font-16 font-medium">
                                                            <a href="{{ route('user.profile', ['slug' => $user->user->slug]) }}">{{ $user->username }}</a>
                                                        </h5>
                                                        <span>{{ $user->job }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            @endforeach
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

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(window).on('hashchange', function () {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '');
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
                let myurl = $(this).attr('href');
                let page = $(this).attr('href').split('page=')[1];
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
