@extends('layouts.dashboard')

@section('subtitle', 'calendars')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('calendars') }}">Calendário</a>
            </li>
            <li class="breadcrumb-item active">Evento <span class="text-muted">#{{ $calendar->id }}</span></li>
        </ol>
    </div>

    <div class="card">

        <!-- Status -->
        <div class="card-body">
            <div class="card-title with-elements">
                <strong class="mr-2">Informação do evento</strong>
                <div class="card-title-elements ml-md-auto">
                    @if($calendar->user_id == auth()->user()->id || auth()->user()->permission->calendar_mod)
                        <a href="{{ route('calendars.edit', [$calendar->id]) }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Evento"></span>
                                Editar
                            </button>
                        </a>
                    @endif

                    @if($calendar->user_id == auth()->user()->id || auth()->user()->permission->calendar_mod)
                        <a href="javascript:;"
                           onclick="document.getElementById('event-del-{{ $calendar->id }}').submit();">
                            <button type="submit" class="btn btn-xs btn-outline-danger">
                                <span class="fas fa-times" data-toggle="tooltip" title="Deletar Evento"></span>
                                Deletar
                            </button>
                        </a>
                        {!! Form::open(['url' => 'calendars/' . $calendar->id, 'method' => 'DELETE', 'id' => 'event-del-' . $calendar->id , 'style' => 'display: none']) !!}
                        {!! Form::close() !!}
                    @endif

                    @if($calendar->user_id !== auth()->user()->id)
                    <a href="{{ route('calendar.report', [$calendar->id]) }}" class="btn btn-xs btn-outline-warning">
                        <span class="fas fa-flag" data-toggle="tooltip" title="Reportar Evento"></span> Reportar
                    </a>
                    @endif
                </div>
            </div>
        </div>
        <hr class="m-0">
        <!-- / Status -->

        <!-- Info -->
        <div class="card-body pb-1">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Evento</div>
                    {{ $calendar->name }}
                </div>
                <div class="col-md-4 mb-3">
                    <div class="text-muted small">Criado por</div>
                    {{ $calendar->user->name }}
                </div>
            </div>
        </div>
        <hr class="m-0">
        <!-- / Info -->

        <!-- Data -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Data de início</div>
                    {{ $calendar->startAt() }}
                </div>
                <div class="col-md-3 mb-3">
                    <div class="text-muted small">Data final</div>
                    {{ $calendar->endAt() }}
                </div>
            </div>
        </div>
        <hr class="m-0">
        <!-- / Data -->

        <!-- Descrição -->
        <div class="card-body">
            <strong class="mr-2">Descrição</strong>
            <hr>
            <div class="row mt-2">
                <div class="col-lg-12 mb-3">
                    {!! $calendar->descriptionHtml() !!}
                </div>
            </div>
        </div>
        <hr class="m-0">
        <!-- / Descrição -->
    </div>

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

    @if(auth()->user()->permission->calendars_comment)
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => ['comments.store'], 'class' => 'form-horizontal']) !!}
            {!! Form::hidden('calendar_id', $calendar->id) !!}
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

@endsection

@section('script')

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
