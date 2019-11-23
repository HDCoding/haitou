@extends('layouts.dashboard')

@section('subtitle', trans('dashboard.settings'))

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
            <li class="breadcrumb-item active">@lang('dashboard.settings')</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="nav-tabs-top demo-vertical-spacing-sm bg-lighter rounded p-4 mb-4 clearfix">
        <ul class="nav nav-tabs tabs-alt nav-responsive-xl nav-fill">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#seo"><b>SEO</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#social"><b>Social</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#analytics"><b>Analytics</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#pontos"><b>Pontos</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#other"><b>Outros</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#legal"><b>Burocrática</b></a>
            </li>
        </ul>
        @includeIf('errors.errors', [$errors])
        <br>
        {!! Form::model($setting, ['url' => 'staff/settings/' . $setting->id, 'method' => 'PUT', 'class' => 'form-horizontal']) !!}
        <div class="tab-content">
            <div class="tab-pane active" id="seo">
                <div class="form-group">
                    {!! Form::label('site_title', 'Site Título: *') !!}
                    {!! Form::text('site_title', $setting->site_title, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'Meta Keywords') !!}
                    {!! Form::textarea('meta_keywords', $setting->meta_keywords, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_description', 'Meta Descrição') !!}
                    {!! Form::textarea('meta_description', $setting->meta_description, ['class' => 'form-control', 'rows' => 3]) !!}
                </div>
            </div>

            <div class="tab-pane" id="social">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('facebook', 'Facebook:') !!}
                            {!! Form::text('facebook', $setting->facebook, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('twitter', 'Twitter:') !!}
                            {!! Form::text('twitter', $setting->twitter, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('pinterest', 'Pinterest:') !!}
                            {!! Form::text('pinterest', $setting->pinterest, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('youtube', 'Youtube:') !!}
                            {!! Form::text('youtube', $setting->youtube, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">

                            {!! Form::label('instagram', 'Instagram:') !!}
                            {!! Form::text('instagram', $setting->instagram, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('twitch', 'Twitch:') !!}
                            {!! Form::text('twitch', $setting->twitch, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('discord', 'Discord:') !!}
                            {!! Form::text('discord', $setting->discord, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="analytics">
                <div class="form-group">
                    {!! Form::label('analytics', 'Analytics') !!}
                    {!! Form::textarea('analytics', $setting->analytics, ['class' => 'form-control', 'rows' => 5]) !!}
                </div>
            </div>

            <div class="tab-pane" id="pontos">
                <div class="text-center">
                    <b class="text-danger">OBS:</b>
                    <b>Min:</b> 1 Ponto - <b>Max:</b> 250 Pontos
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('points_signup', 'Singup:') !!}
                            {!! Form::number('points_signup', $setting->points_signup, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_invite', 'Convidar:') !!}
                            {!! Form::number('points_invite', $setting->points_invite, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_download', 'Download:') !!}
                            {!! Form::number('points_download', $setting->points_download, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_comment', 'Comentar:') !!}
                            {!! Form::number('points_comment', $setting->points_comment, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_upload', 'Upload:') !!}
                            {!! Form::number('points_upload', $setting->points_upload, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_rating', 'Rating:') !!}
                            {!! Form::number('points_rating', $setting->points_rating, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('points_topic', 'Tópico:') !!}
                            {!! Form::number('points_topic', $setting->points_topic, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_post', 'Post:') !!}
                            {!! Form::number('points_post', $setting->points_post, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_delete', 'Deletar:') !!}
                            {!! Form::number('points_delete', $setting->points_delete, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_thanks', 'Agradecer:') !!}
                            {!! Form::number('points_thanks', $setting->points_thanks, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('points_report', 'Reportar:') !!}
                            {!! Form::number('points_report', $setting->points_report, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="other">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('signup_on', 'Registro aberto?') !!}
                            {!! Form::select('signup_on', [true => 'Sim', false => 'Não'], $setting->signup_on, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('invite_on', 'Convites liberado?') !!}
                            {!! Form::select('invite_on', [true => 'Sim', false => 'Não'], $setting->invite_on, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('forum_on', 'Fórum Online?') !!}
                            {!! Form::select('forum_on', [true => 'Sim', false => 'Não'], $setting->forum_on, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('rnh_on', 'H-N-R Ligado?') !!}
                            {!! Form::select('rnh_on', [true => 'Sim', false => 'Não'], $setting->rnh_on, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('max_ratio', 'Max. Ratio:') !!}
                            {!! Form::number('max_ratio', $setting->max_ratio, ['class' => 'form-control', 'step' => 'any']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('min_ratio', 'Min. Ratio:') !!}
                            {!! Form::number('min_ratio', $setting->min_ratio, ['class' => 'form-control', 'step' => 'any']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('low_ratio', 'Low. Ratio:') !!}
                            {!! Form::number('low_ratio', $setting->low_ratio, ['class' => 'form-control', 'step' => 'any']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('invitedays', 'Convite limite de dias:') !!}
                            {!! Form::number('invitedays', $setting->invitedays, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="legal">
                <div class="form-group">
                    {!! Form::label('terms', 'Termos:') !!}
                    {!! Form::textarea('terms', $setting->terms, ['class' => 'form-control editor', 'rows' => 8]) !!}

                </div>
                <div class="form-group">
                    {!! Form::label('privacy', 'Privacidade:') !!}
                    {!! Form::textarea('privacy', $setting->privacy, ['class' => 'form-control editor', 'rows' => 8]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('disclaimer', 'Aviso Legal:') !!}
                    {!! Form::textarea('disclaimer', $setting->disclaimer, ['class' => 'form-control editor', 'rows' => 8]) !!}
                </div>
            </div>

            {!! Form::submit('Atualizar', ['class' => 'btn btn-success btn-rounded btn-outline-success']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('script')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/bbcode.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //terms
            var terms = document.getElementById('terms');
            sceditor.create(terms, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
            //privacy
            var privacy = document.getElementById('privacy');
            sceditor.create(privacy, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
            //terms
            var disclaimer = document.getElementById('disclaimer');
            sceditor.create(disclaimer, {
                format: 'bbcode',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
