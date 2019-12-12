@extends('layouts.dashboard')

@section('title', 'Open Iconic')

@section('css')
    <style>
        .icon-example {
            width: 70px;
            height: 70px;
            font-size: 20px;
            position: relative;
        }

        .icon-example:after {
            content: attr(data-title);
            display: none;
            position: absolute;
            background: #444;
            color: #fff;
            padding: 3px 6px;
            border-radius: 2px;
            bottom: 100%;
            left: 50%;
            font-weight: bold;
            transform: translate(-50%, -4px);
            font-size: 12px;
            white-space: nowrap;
        }

        .icon-example:hover:after {
            display: block;
        }
    </style>
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
                            <li class="breadcrumb-item active" aria-current="page">Open Iconic</li>
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
                        @include('staff.icons.links')

                        <div class="py-2 my-4 mx-auto" style="max-width:300px">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ion ion-ios-search"></i></span>
                                </div>
                                <input type="text" class="form-control" id="icons-search" placeholder="Pesquisar...">
                            </div>
                        </div>

                        <div id="icons-container" class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            var icons = ['account-login', 'account-logout', 'action-redo', 'action-undo', 'align-center', 'align-left', 'align-right', 'aperture', 'arrow-bottom', 'arrow-circle-bottom', 'arrow-circle-left', 'arrow-circle-right', 'arrow-circle-top', 'arrow-left', 'arrow-right', 'arrow-thick-bottom', 'arrow-thick-left', 'arrow-thick-right', 'arrow-thick-top', 'arrow-top', 'audio-spectrum', 'audio', 'badge', 'ban', 'bar-chart', 'basket', 'battery-empty', 'battery-full', 'beaker', 'bell', 'bluetooth', 'bold', 'bolt', 'book', 'bookmark', 'box', 'briefcase', 'british-pound', 'browser', 'brush', 'bug', 'bullhorn', 'calculator', 'calendar', 'camera-slr', 'caret-bottom', 'caret-left', 'caret-right', 'caret-top', 'cart', 'chat', 'check', 'chevron-bottom', 'chevron-left', 'chevron-right', 'chevron-top', 'circle-check', 'circle-x', 'clipboard', 'clock', 'cloud-download', 'cloud-upload', 'cloud', 'cloudy', 'code', 'cog', 'collapse-down', 'collapse-left', 'collapse-right', 'collapse-up', 'command', 'comment-square', 'compass', 'contrast', 'copywriting', 'credit-card', 'crop', 'dashboard', 'data-transfer-download', 'data-transfer-upload', 'delete', 'dial', 'document', 'dollar', 'double-quote-sans-left', 'double-quote-sans-right', 'double-quote-serif-left', 'double-quote-serif-right', 'droplet', 'eject', 'elevator', 'ellipses', 'envelope-closed', 'envelope-open', 'euro', 'excerpt', 'expand-down', 'expand-left', 'expand-right', 'expand-up', 'external-link', 'eye', 'eyedropper', 'file', 'fire', 'flag', 'flash', 'folder', 'fork', 'fullscreen-enter', 'fullscreen-exit', 'globe', 'graph', 'grid-four-up', 'grid-three-up', 'grid-two-up', 'hard-drive', 'header', 'headphones', 'heart', 'home', 'image', 'inbox', 'infinity', 'info', 'italic', 'justify-center', 'justify-left', 'justify-right', 'key', 'laptop', 'layers', 'lightbulb', 'link-broken', 'link-intact', 'list-rich', 'list', 'location', 'lock-locked', 'lock-unlocked', 'loop-circular', 'loop-square', 'loop', 'magnifying-glass', 'map-marker', 'map', 'media-pause', 'media-play', 'media-record', 'media-skip-backward', 'media-skip-forward', 'media-step-backward', 'media-step-forward', 'media-stop', 'medical-cross', 'menu', 'microphone', 'minus', 'monitor', 'moon', 'move', 'musical-note', 'paperclip', 'pencil', 'people', 'person', 'phone', 'pie-chart', 'pin', 'play-circle', 'plus', 'power-standby', 'print', 'project', 'pulse', 'puzzle-piece', 'question-mark', 'rain', 'random', 'reload', 'resize-both', 'resize-height', 'resize-width', 'rss-alt', 'rss', 'script', 'share-boxed', 'share', 'shield', 'signal', 'signpost', 'sort-ascending', 'sort-descending', 'spreadsheet', 'star', 'sun', 'tablet', 'tag', 'tags', 'target', 'task', 'terminal', 'text', 'thumb-down', 'thumb-up', 'timer', 'transfer', 'trash', 'underline', 'vertical-align-bottom', 'vertical-align-center', 'vertical-align-top', 'video', 'volume-high', 'volume-low', 'volume-off', 'warning', 'wifi', 'wrench', 'x', 'yen', 'zoom-in', 'zoom-out'];
            var template = '<div id="icon-%icon-id%" data-title="%icon-class%" class="card icon-example d-inline-flex justify-content-center align-items-center my-2 mx-2"><i class="oi oi-%icon% d-block"></i></div>'
            var $container = $('#icons-container');

            for (var i = 0, l = icons.length; i < l; i++) {
                $container.append($(template
                    .replace(/%icon\-id%/g, icons[i])
                    .replace(/%icon%/g, icons[i])
                    .replace(/%icon\-class%/g, '.oi.oi-' + icons[i])
                ));
            }

            $('#icons-search').on('input', function() {
                var val = String(this.value).replace(/^\s+|\s+$/g, '');

                if (!val) return $container.find('> *').removeClass('d-none').addClass('d-inline-flex');

                $container.find('> *').removeClass('d-inline-flex').addClass('d-none');

                for (var j = 0, k = icons.length; j < k; j++) {
                    if (icons[j].indexOf(val) !== -1) {
                        $('#icon-' + icons[j]).removeClass('d-none').addClass('d-inline-flex');
                    }
                }
            });
        });
    </script>
@endsection
