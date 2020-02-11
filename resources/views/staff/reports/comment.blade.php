@extends('layouts.dashboard')

@section('title', 'Comentário')

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
                            <li class="breadcrumb-item active" aria-current="page">Comentário</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $report->name }}</h4>
                        {!! $report->reasonHtml() !!}
                    </div>
                </div>
                @if($report->is_solved)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Solução: </h4>
                            <h5 class="card-subtitle">{{ format_date_time($report->updated_at) }}</h5>
                            <ul class="list-unstyled m-t-40">
                                <li class="media">
                                    <img class="m-r-15" src="{{ $report->staff->avatar() }}" width="60" alt="{{ $report->staff->username }}">
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-1">{{ $report->staff->username }}</h5>
                                        {!! $report->solutionHtml() !!}
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if(!$report->is_solved)
                    <div class="card">
                        <div class="card-body">
                            {!! Form::model($report, ['url' => 'staff/reports/' . $report->id . '/solve', 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
                            <div class="form-group">
                                <div class="col-xs-10">
                                    <div class="form-material">
                                        {!! Form::label('solution', 'Solução: *') !!}
                                        {!! Form::textarea('solution', null, ['class' => 'form-control', 'rows' => '8', 'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-9">
                                    {!! Form::submit('Solucionar', ['class' => 'btn btn-info btn-rounded']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Report Info</h4>
                    </div>
                    <div class="card-body bg-light">
                        <div class="row text-center">
                            <div class="col-6 m-t-10 m-b-10">
                                {!! $report->type() !!}
                            </div>
                            <div class="col-6 m-t-10 m-b-10">
                                {{ format_date_time($report->created_at) }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="p-t-20">Membro</h5>
                        <span>{{ $report->user->username }}</span>
                        @if($report->is_solved)
                            <h5 class="m-t-30">Staff</h5>
                            <span>{{ $report->staff->username }}</span>
                        @endif
                        <br/>
                        <h5 class="p-t-20">Link</h5>
                        <span>
                            <a href="{{ route('comments.show', [$report->comment->id]) }}" target="_blank">
                                {{ $report->name }}
                            </a>
                        </span>
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
