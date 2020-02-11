@extends('layouts.dashboard')

@section('title', $calendar->name)

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('calendars') }}">Calendário</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Evento: {{ $calendar->id }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Informação do evento</h4>
                        @includeIf('errors.errors', [$errors])
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6">
                                <h4 class="box-title m-t-40">Evento</h4>
                                <p>{{ $calendar->name }}</p>
                                <h4 class="box-title m-t-40">Criado por</h4>
                                <p>{{ $calendar->username }}</p>
                                <h4 class="box-title m-t-40">Data de início</h4>
                                <p>{{ format_date_time($calendar->start_date) }}</p>
                                <h4 class="box-title m-t-40">Data final</h4>
                                <p>{{ format_date_time($calendar->end_date) }}</p>
                                <h4 class="box-title m-t-40">Agradecimentos</h4>
                                <p>({{ $total }})</p>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-6">
                                <h4 class="box-title m-t-40">Descrição</h4>
                                <p class="m-b-40">{!! $calendar->descriptionHtml() !!}</p>

                                @if($calendar->user_id == auth()->user()->id)
                                    <a href="{{ route('calendars.edit', [$calendar->id]) }}">
                                        <button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" title="Editar Evento">
                                            <i class="fas fa-pencil-alt"></i> Editar
                                        </button>
                                    </a>
                                @endif

                                @if($calendar->user_id == auth()->user()->id)
                                    <a href="javascript:;"
                                       onclick="document.getElementById('event-del-{{ $calendar->id }}').submit();">
                                        <button type="submit" class="btn btn-xs btn-danger" data-toggle="tooltip" title="Deletar Evento">
                                            <i class="fas fa-times"></i> Deletar
                                        </button>
                                    </a>
                                    {!! Form::open(['url' => 'calendars/' . $calendar->id, 'method' => 'DELETE', 'id' => 'event-del-' . $calendar->id , 'style' => 'display: none']) !!}
                                    {!! Form::close() !!}
                                @endif

                                @if($calendar->user_id !== auth()->user()->id)
                                    <a class="btn btn-xs btn-dark" href="{{ route('calendar.report', [$calendar->id]) }}" data-toggle="tooltip" title="Reportar Evento">
                                        <i class="fas fa-flag"></i> Reportar
                                    </a>
                                @endif

                                @if(!$thanks)
                                    @if (auth()->user()->id !== $calendar->user_id)
                                        <h4 class="box-title m-t-40">Agradecer</h4>
                                        {!! Form::open(['route' => ['calendar.thanks', $calendar->id], 'class' => 'form-horizontal']) !!}
                                        <button type="submit" class="btn btn-danger btn-rounded" data-toggle="tooltip" title="Obrigada(o)"><i class="ti-heart"></i></button>
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xlg-5 col-md-5">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#nav-comments" role="tab" aria-controls="pills-profile" aria-selected="false">Comentários</a>
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
                                @if(auth()->user()->can('comentar-calendarios'))
                                <div class="card">
                                    <div class="card-body">
                                        {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
                                        {!! Form::hidden('calendar_id', $calendar->id) !!}
                                        <div class="form-group">
                                            {!! Form::label('content', 'Comentário: *') !!}
                                            {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => 5]) !!}
                                        </div>
                                        {!! Form::submit('Comentar', ['class' => 'btn btn-primary btn-rounded']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                @else
                                <p class="text-center font-weight-bold text-danger">Sua permissão de fazer comentários em Calendários foram revogadas!!</p>
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
