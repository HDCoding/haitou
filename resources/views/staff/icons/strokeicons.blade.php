@extends('layouts.dashboard')

@section('title', 'Stroke Icons 7')

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
                            <li class="breadcrumb-item active" aria-current="page">Stroke Icons 7</li>
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
            var icons = ['album', 'arc', 'back-2', 'bandaid', 'car', 'diamond', 'door-lock', 'eyedropper', 'female', 'gym', 'hammer', 'headphones', 'helm', 'hourglass', 'leaf', 'magic-wand', 'male', 'map-2', 'next-2', 'paint-bucket', 'pendrive', 'photo', 'piggy', 'plugin', 'refresh-2', 'rocket', 'settings', 'shield', 'smile', 'usb', 'vector', 'wine', 'cloud-upload', 'cash', 'close', 'bluetooth', 'cloud-download', 'way', 'close-circle', 'id', 'angle-up', 'wristwatch', 'angle-up-circle', 'world', 'angle-right', 'volume', 'angle-right-circle', 'users', 'angle-left', 'user-female', 'angle-left-circle', 'up-arrow', 'angle-down', 'switch', 'angle-down-circle', 'scissors', 'wallet', 'safe', 'volume2', 'volume1', 'voicemail', 'video', 'user', 'upload', 'unlock', 'umbrella', 'trash', 'tools', 'timer', 'ticket', 'target', 'sun', 'study', 'stopwatch', 'star', 'speaker', 'signal', 'shuffle', 'shopbag', 'share', 'server', 'search', 'film', 'science', 'disk', 'ribbon', 'repeat', 'refresh', 'add-user', 'refresh-cloud', 'paperclip', 'radio', 'note2', 'print', 'network', 'prev', 'mute', 'power', 'medal', 'portfolio', 'like2', 'plus', 'left-arrow', 'play', 'key', 'plane', 'joy', 'photo-gallery', 'pin', 'phone', 'plug', 'pen', 'right-arrow', 'paper-plane', 'delete-user', 'paint', 'bottom-arrow', 'notebook', 'note', 'next', 'news-paper', 'musiclist', 'music', 'mouse', 'more', 'moon', 'monitor', 'micro', 'menu', 'map', 'map-marker', 'mail', 'mail-open', 'mail-open-file', 'magnet', 'loop', 'look', 'lock', 'lintern', 'link', 'like', 'light', 'less', 'keypad', 'junk', 'info', 'home', 'help2', 'help1', 'graph3', 'graph2', 'graph1', 'graph', 'global', 'gleam', 'glasses', 'gift', 'folder', 'flag', 'filter', 'file', 'expand1', 'exapnd2', 'edit', 'drop', 'drawer', 'download', 'display2', 'display1', 'diskette', 'date', 'cup', 'culture', 'crop', 'credit', 'copy-file', 'config', 'compass', 'comment', 'coffee', 'cloud', 'clock', 'check', 'chat', 'cart', 'camera', 'call', 'calculator', 'browser', 'box2', 'box1', 'bookmarks', 'bicycle', 'bell', 'battery', 'ball', 'back', 'attention', 'anchor', 'albums', 'alarm', 'airplay'];
            var template = '<div id="icon-%icon-id%" data-title="%icon-class%" class="card icon-example d-inline-flex justify-content-center align-items-center my-2 mx-2"><i class="pe-7s-%icon% d-block"></i></div>'
            var $container = $('#icons-container');

            for (var i = 0, l = icons.length; i < l; i++) {
                $container.append($(template
                    .replace(/%icon\-id%/g, icons[i])
                    .replace(/%icon%/g, icons[i])
                    .replace(/%icon\-class%/g, '.pe-7s-' + icons[i])
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
