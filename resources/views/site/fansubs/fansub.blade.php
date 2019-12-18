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
                        <center class="m-t-30"> <img src="{{ $fansub->logo }}" class="img-thumbnail" width="450" alt="Logo" />
                            <h4 class="card-title m-t-10">{{ $fansub->name }}</h4>
                            <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
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
                    @if($fansub->fansub_mod($fansub->id))
                        <div class="card-body">
                            <div class="ml-auto">
                                <a href="{{ url('staff/fansubs/' . $fansub->id . '/edit') }}" class="btn btn-xs btn-outline-success">
                                    <i class="ion ion-ios-link"></i> Editar
                                </a>
                            </div>
                        </div>
                    @endif
                    @if($fansub->fansub_mod($fansub->id))
                        <div class="ml-auto">
                            <a href="{{ url('staff/fansub/' . $fansub->id . '/members') }}" class="btn btn-xs btn-outline-primary">
                                <i class="ion ion-md-add"></i> Adicionar/Editar Membros
                            </a>
                        </div>
                    @endif
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
                                        <a class="text-info" href="{{ $fansub->website }}" target="_blank">{{ $fansub->name }}</a>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Discord</strong>
                                        <br>
                                        <a class="text-info" href="{{ $fansub->discord }}" target="_blank">Discord</a>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>IRC Server</strong>
                                        <br>
                                        <p class="text-muted">{{ $fansub->irc_server }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <strong>IRC Channel</strong>
                                        <br>
                                        <p class="text-muted">{{ $fansub->irc_channel }}</p>
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
{{--                                @if(auth()->user()->permission->fansubs_comment)--}}
                                    <div class="card">
                                        <div class="card-body">
                                            {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                            {!! Form::hidden('fansub_id', $fansub->id) !!}
                                            <div class="form-group">
                                                {!! Form::label('content', 'Comentário: *') !!}
                                                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                            </div>
                                            {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-outline-primary']) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
{{--                                @else--}}
                                    <p class="text-center font-weight-bold text-danger">Sua permissão de fazer comentários em Fansubs foram revogadas!!</p>
{{--                                @endif--}}
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-members" role="tabpanel" aria-labelledby="pills-setting-tab">
                            <div class="card-body">
                                <form class="form-horizontal form-material">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" value="password" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-12">Select Country</label>
                                        <div class="col-sm-12">
                                            <select class="form-control form-control-line">
                                                <option>London</option>
                                                <option>India</option>
                                                <option>Usa</option>
                                                <option>Canada</option>
                                                <option>Thailand</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
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
