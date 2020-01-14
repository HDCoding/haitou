@extends('layouts.dashboard')

@section('title', $studio->name)

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $studio->name }}</li>
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
                        <center class="m-t-30"> <img src="{{ $studio->logo }}" class="img-thumbnail" width="450" alt="Poster" />
                            <h4 class="card-title m-t-10 m-b-20">{{ $studio->name }}</h4>
                        </center>
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
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Website</strong>
                                        <br>
                                        @if(!empty($studio->website))
                                        <a class="text-info" href="{{ $studio->website }}" target="_blank">{{ $studio->name }}</a>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <p class="m-t-30">
                                    {!! $studio->descriptionHtml() !!}
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
                                @if(auth()->user()->can('comentar-estudios'))
                                    <div class="card">
                                        <div class="card-body">
                                            {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                            {!! Form::hidden('studio_id', $studio->id) !!}
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
