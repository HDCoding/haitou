@extends('layouts.dashboard')

@section('subtitle', 'Linearicons')

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

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item active">Linearicons</li>
        </ol>
    </div>

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

@endsection

@section('script')
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            var icons = ['home', 'apartment', 'pencil', 'magic-wand', 'drop', 'lighter', 'poop', 'sun', 'moon', 'cloud', 'cloud-upload', 'cloud-download', 'cloud-sync', 'cloud-check', 'database', 'lock', 'cog', 'trash', 'dice', 'heart', 'star', 'star-half', 'star-empty', 'flag', 'envelope', 'paperclip', 'inbox', 'eye', 'printer', 'file-empty', 'file-add', 'enter', 'exit', 'graduation-hat', 'license', 'music-note', 'film-play', 'camera-video', 'camera', 'picture', 'book', 'bookmark', 'user', 'users', 'shirt', 'store', 'cart', 'tag', 'phone-handset', 'phone', 'pushpin', 'map-marker', 'map', 'location', 'calendar-full', 'keyboard', 'spell-check', 'screen', 'smartphone', 'tablet', 'laptop', 'laptop-phone', 'power-switch', 'bubble', 'heart-pulse', 'construction', 'pie-chart', 'chart-bars', 'gift', 'diamond', 'linearicons', 'dinner', 'coffee-cup', 'leaf', 'paw', 'rocket', 'briefcase', 'bus', 'car', 'train', 'bicycle', 'wheelchair', 'select', 'earth', 'smile', 'sad', 'neutral', 'mustache', 'alarm', 'bullhorn', 'volume-high', 'volume-medium', 'volume-low', 'volume', 'mic', 'hourglass', 'undo', 'redo', 'sync', 'history', 'clock', 'download', 'upload', 'enter-down', 'exit-up', 'bug', 'code', 'link', 'unlink', 'thumbs-up', 'thumbs-down', 'magnifier', 'cross', 'menu', 'list', 'chevron-up', 'chevron-down', 'chevron-left', 'chevron-right', 'arrow-up', 'arrow-down', 'arrow-left', 'arrow-right', 'move', 'warning', 'question-circle', 'menu-circle', 'checkmark-circle', 'cross-circle', 'plus-circle', 'circle-minus', 'arrow-up-circle', 'arrow-down-circle', 'arrow-left-circle', 'arrow-right-circle', 'chevron-up-circle', 'chevron-down-circle', 'chevron-left-circle', 'chevron-right-circle', 'crop', 'frame-expand', 'frame-contract', 'layers', 'funnel', 'text-format', 'text-format-remove', 'text-size', 'bold', 'italic', 'underline', 'strikethrough', 'highlight', 'text-align-left', 'text-align-center', 'text-align-right', 'text-align-justify', 'line-spacing', 'indent-increase', 'indent-decrease', 'pilcrow', 'direction-ltr', 'direction-rtl', 'page-break', 'sort-alpha-asc', 'sort-amount-asc', 'hand', 'pointer-up', 'pointer-right', 'pointer-down', 'pointer-left'];
            var template = '<div id="icon-%icon-id%" data-title="%icon-class%" class="card icon-example d-inline-flex justify-content-center align-items-center my-2 mx-2"><i class="lnr lnr-%icon% d-block"></i></div>'
            var $container = $('#icons-container');

            for (var i = 0, l = icons.length; i < l; i++) {
                $container.append($(template
                    .replace(/%icon\-id%/g, icons[i])
                    .replace(/%icon%/g, icons[i])
                    .replace(/%icon\-class%/g, '.lnr.lnr-' + icons[i])
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
