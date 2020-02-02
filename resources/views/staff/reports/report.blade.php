@extends('layouts.dashboard')

@section('title', 'Report')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('staff/reports') }}">@lang('dashboard.reports')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                        <h4 class="card-title">Report</h4>
                        @includeIf('errors.errors', [$errors])

                        <h5 class="push-15 m-b-3">Link:
                            @if ($report->calendar)
                                <p class="well well-sm mt-2">
                                    <a href="{{ route('calendars', ['id' => $report->calendar->id]) }}" target="_blank">
                                        {{ $report->name }}
                                    </a>
                                </p>
                            @endif

                            @if ($report->comment)
                                <p class="well well-sm mt-2">
                                    <a href="{{ route('comments.show', ['id' => $report->comment->id]) }}" target="_blank">
                                        {{ $report->name }}
                                    </a>
                                </p>
                            @endif

                            @if ($report->member)
                                <p class="well well-sm mt-2">
                                    <a href="{{ route('user.profile', ['slug' => $report->member->slug]) }}" target="_blank">
                                        {{ $report->name }}
                                    </a>
                                </p>
                            @endif

                            @if ($report->post)
                                <p class="well well-sm mt-2">
                                    <a href="{{ route('post.edit.form', [$report->post->topic->id, $report->post->topic->slug, $report->post->id]) }}" target="_blank">
                                        {{ $report->name }}
                                    </a>
                                </p>
                            @endif

                            @if ($report->torrent)
                                <p class="well well-sm mt-2">
                                    <a href="{{ route('torrent.show', [$report->torrent->id, $report->torrent->slug]) }}" target="_blank">
                                        {{ $report->name }}
                                    </a>
                                </p>
                            @endif
                        </h5>

                        <h5 class="push-15 m-b-3">Categoria: {!! $report->type() !!}</h5>
                        <p class="h5 mt-5">Problema:</p>

                        {!! $report->reasonHtml() !!}

                        @if($report->is_solved)
                            <p class="h5 push-15 mt-4">Solução:</p>
                            <div class="col-sm-12">
                                {!! $report->solutionHtml() !!}
                            </div>
                        @else
                            {!! Form::model($report, ['url' => 'staff/reports/' . $report->id, 'method' => 'PUT', 'class' => 'form-horizontal mt-5']) !!}
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <div class="form-material">
                                        {!! Form::label('solution', 'Solução: *') !!}
                                        {!! Form::textarea('solution', null, ['class' => 'form-control', 'rows' => '8']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    {!! Form::submit('Solucionar', ['class' => 'btn btn-primary btn-rounded']) !!}
                                </div>
                            </div>
                            <br>
                            {!! Form::close() !!}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            let textarea = document.getElementById('solution');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
