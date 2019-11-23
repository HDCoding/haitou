@extends('layouts.dashboard')

@section('subtitle', 'Report')

@section('css')
    <!-- sceditor -->
    <link rel="stylesheet" href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}">
@endsection

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/reports') }}">@lang('dashboard.reports')</a>
            </li>
            <li class="breadcrumb-item active">Report</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card mb-4">
        <p class="card-header">Report:</p>
        <div class="card-body">

            <div class="block">

                <div class="block">
                    <div class="block-content">
                        @includeIf('errors.errors', [$errors])

                        <h5 class="push-15 mb-3">Link:
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

                        @if ($report->forum_post)
                            <p class="well well-sm mt-2">
                                <a href="{{ route('user.profile', ['slug' => $report->forum_post->slug]) }}" target="_blank">
                                    {{ $report->name }}
                                </a>
                            </p>
                        @endif

                        @if ($report->torrent)
                            <p class="well well-sm mt-2">
                                <a href="{{ route('torrent.show', ['id' => $report->torrent->id, 'slug' => $report->torrent->slug]) }}" target="_blank">
                                    {{ $report->name }}
                                </a>
                            </p>
                        @endif
                        </h5>

                        <h5 class="push-15 mb-3">Categoria: {!! $report->getType() !!}</h5>
                        <p class="h5 mt-5">Problema:</p>

                        {!! $report->getReasonHtml() !!}

                        @if($report->is_solved)
                            <p class="h5 push-15 mt-4">Solução:</p>
                            <div class="col-sm-12">
                                {!! $report->getSolutionHtml() !!}
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
                                    {!! Form::submit('Solucionar', ['class' => 'btn btn-primary btn-rounded btn-outline-primary']) !!}
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

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- script -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function() {
            var textarea = document.getElementById('solution');
            sceditor.create(textarea, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
