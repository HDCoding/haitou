<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FleetCart</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Rubik:400,500">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <style>
            html,
            body {
                height: 100%;
            }

            body {
                font-family: "Open Sans", sans-serif;
                font-size: 16px;
            }

            h1, h2, h3, h4, h5, h6,
            ul, li,
            p {
                margin: 0;
                padding: 0;
            }

            h1, h2, h3, h4, h5, h6 {
                font-family: "Rubik", sans-serif;
                font-weight: 400;
                color: #666666;
            }

            h1 {
                font-size: 36px;
                line-height: 44px;
            }

            h2 {
                font-size: 30px;
                line-height: 36px;
            }

            h3 {
                font-size: 24px;
                line-height: 29px;
            }

            h4 {
                font-size: 21px;
                line-height: 26px;
            }

            h5 {
                font-size: 18px;
                line-height: 22px;
            }

            h6 {
                font-size: 16px;
                line-height: 20px;
            }

            p {
                font-size: 16px;
                line-height: 22px;
                color: #777777;
                letter-spacing: 0.2px;
            }

            div:active,
            div:focus,
            div:visited,
            a:active,
            a:focus,
            a:visited {
                outline: 0;
            }

            a {
                transition: 200ms ease-in-out;
            }

            .table {
                margin-bottom: 0;
            }

            .table > thead > tr > th {
                color: #666666;
                border-bottom: 1px solid #e9e9e9;
            }

            .table > tbody > tr > td {
                color: #777777;
                padding: 12px 8px;
                border-color: #f1f1f1;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .form-horizontal .control-label {
                font-size: 15px;
                padding-top: 8px;
                text-align: left;
            }

            .control-label > span {
                color: #fc4b4b;
            }

            .form-control {
                border-color: #d9d9d9;
                border-radius: 3px;
                box-shadow: none;
                height: 40px;
                transition: 200ms ease-in-out;
            }

            .form-control:focus {
                box-shadow: none;
                border-color: #0068e1;
            }

            .help-block {
                font-size: 14px;
                margin-bottom: 5px;
            }

            .has-error .control-label,
            .has-error .help-block {
                color: #ff3366;
            }

            .has-error .form-control {
                border-color: #ff3366;
            }

            .has-error .form-control:focus {
                box-shadow: none;
                border-color: #ff3366;
            }

            label {
                color: #666666;
            }

            .custom-select-black {
                appearance: none;
                -webkit-appearance: none;
                background: transparent url('../../public/modules/admin/images/arrow-black.png') no-repeat right 8px center;
                background-size: 10px;
            }

            .alert {
                font-family: "Rubik", sans-serif;
                border: none;
                border-radius: 3px;
                color: #ffffff;
            }

            .alert .close {
                color: #ffffff;
                opacity: 0.7;
                text-shadow: none;
                transition: 200ms ease-in-out;
            }

            .alert .close:hover {
                opacity: 1;
            }

            .alert-danger {
                background: #ff5252;
            }

            .alert .close > i {
                -webkit-text-stroke: 2px #ff5252;
            }

            .btn {
                font-family: "Open Sans", sans-serif;
                font-size: 16px;
                border: 1px solid;
                padding: 9px 20px;
                border-radius: 3px;
                background: transparent;
                color: #555555;
                letter-spacing: 0.2px;
                transition: 200ms ease-in-out;
                outline: 0 !important;
            }

            .btn-primary {
                background: #0068e1;
                color: #ffffff;
                border-color: #0068e1;
            }

            .btn-primary:active,
            .btn-primary:hover,
            .btn-primary:focus,
            .btn-primary:active:focus {
                background: #0059bd;
                border-color: #0059bd;
            }

            .btn-primary.disabled,
            .btn-primary[disabled] {
                opacity: 0.6;
            }

            /* modal */
            .modal {
                text-align: center;
                padding-right: 0 !important;
            }

            .modal .modal-dialog {
                top: 50%;
                width: 500px;
                display: inline-block;
                margin: auto;
                vertical-align: middle;
                transform: translate(0, -50%) scale(0.8);
            }

            .modal .content {
                float: none;
                margin: 0 auto;
                padding: 0;
                overflow: visible !important;
                box-shadow: 0 2px 5px 0 #555555;
            }

            .modal .modal-body {
                margin-right: -1px;
            }

            .modal.fade .modal-dialog {
                opacity: 0;
                transform: translate(0, -50%) scale(0.8);
                transition: 200ms ease-in-out;
            }

            .modal.fade.in .modal-dialog {
                opacity: 1;
                transform: translate(0, -50%) scale(1);
            }

            .modal-backdrop.in {
                opacity: 0.7;
            }

            /* installer */

            .installer-wrapper {
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                background: #31629f;
            }

            .installer-wrapper > .wrapper {
                height: 500px;
                width: 900px;
                background: #ffffff;
                border-radius: 3px;
                overflow: hidden;
                -webkit-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.3);
                -moz-box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.3);
                box-shadow: 0px 0px 30px 0px rgba(0, 0, 0, 0.3);
            }

            .left-sidebar {
                height: 500px;
                width: 28%;
                background: #02a9ee;
                float: left;
            }

            .left-sidebar > .list-inline {
                margin: 25px 0 0;
                padding: 0 30px;
            }

            .left-sidebar li {
                position: relative;
                display: block;
                float: none;
                color: #f1f1f1;
                padding: 8px 0 8px 30px;
                cursor: default;
            }

            .left-sidebar li:after {
                position: absolute;
                content: "";
                left: 0;
                top: 9px;
                height: 20px;
                width: 20px;
                text-align: center;
                background: #81d2f6;
                border-radius: 50%;
            }

            .left-sidebar li.active {
                font-weight: 600;
                color: #ffffff;
            }

            .left-sidebar li.active:before {
                position: absolute;
                content: "";
                left: 6px;
                top: 15px;
                height: 8px;
                width: 8px;
                background: #fafafa;
                border-radius: 50%;
                z-index: 1;
            }

            .left-sidebar li.complete:after {
                position: absolute;
                font-family: FontAwesome;
                font-size: 15px;
                content: "\f00c";
                color: #ffffff;
                -webkit-text-stroke: 0.5px #81d2f6;
            }

            .content-wrapper {
                width: 72%;
                float: left;
            }

            .content-wrapper > .content {
                height: 434px;
                margin: 33px 0;
                padding: 0 30px;
                overflow: auto;
            }

            .box {
                margin-top: 30px;
            }

            .box > p {
                margin-bottom: 12px;
            }

            .box .table tr > td:last-child > i {
                font-size: 20px;
                -webkit-text-stroke: 1px #ffffff;
            }

            .box .table tr > td > i.fa-check {
                color: #37bc9b;
            }

            .box .table tr > td > i.fa-times {
                color: #fc4b4b;
            }

            .installation-message {
                margin: 30px 0 60px;
            }

            .installation-message > i {
                font-size: 80px;
                color: #37bc9b;
                -webkit-text-stroke: 7px #ffffff;
            }

            .visit {
                display: block;
                background: #f1f4f9;
                padding: 40px 0;
                border-radius: 3px;
                border: 1px solid transparent;
                transition: 200ms ease-in-out;
            }

            .visit:active,
            .visit:hover,
            .visit:focus {
                text-decoration: none;
            }

            .visit .icon {
                display: block;
                text-align: center;
                margin-bottom: 10px;
            }

            .visit .icon > i {
                font-size: 48px;
                color: #626060;
                -webkit-text-stroke: 1px #f5f5f5;
                transition: 200ms ease-in-out;
            }

            .visit:hover {
                border-color: rgba(49, 98, 159, 0.2);
            }

            .visit:hover .icon > i {
                color: #31629f;
            }

            .content-buttons {
                padding-top: 20px;
                border-top: 1px solid #d9d9d9;
            }

            .p-b-0 {
                padding-bottom: 0;
            }

            .btn-loading {
                position: relative;
                color: transparent !important;
            }

            .btn-loading:after {
                position: absolute;
                content: "";
                left: 0;
                top: 0;
                right: 0;
                bottom: 0;
                margin: auto;
                height: 16px;
                width: 16px;
                border: 2px solid #ffffff;
                border-radius: 100%;
                border-right-color: transparent;
                border-top-color: transparent;
                animation: spinAround 600ms infinite linear;
            }

            .btn-loading.btn-default:after {
                border: 2px solid #0068e1;
                border-right-color: transparent;
                border-top-color: transparent;
            }

            @keyframes spinAround {
                from {
                    transform: rotate(0deg);
                }

                to {
                    transform: rotate(359deg);
                }
            }

            @media screen and (max-width: 991px) {
                .left-sidebar {
                    border-right: none;
                }
            }

            @media screen and (max-width: 940px) {
                html,
                body {
                    height: auto;
                }

                .installer-wrapper {
                    height: auto;
                    padding: 15px;
                }

                .installer-wrapper > .wrapper {
                    height: auto;
                    width: 100%;
                }

                .left-sidebar {
                    height: auto;
                    width: 100%;
                    float: none;
                }

                .left-sidebar > .list-inline {
                    margin-bottom: 25px;
                }

                .content-wrapper {
                    width: 100%;
                    float: none;
                }

                .content-wrapper > .content {
                    height: auto;
                }
            }

            @media screen and (max-width: 767px) {
                .table-responsive {
                    border: none;
                    margin-bottom: 0;
                }

                .form-horizontal .control-label {
                    padding-top: 0;
                }

                .configure-form {
                    padding-top: 15px;
                }

                .visit-wrapper > .row > .col-sm-6:last-child > .visit {
                    margin-top: 30px;
                }
            }
        </style>
    </head>

    <body>
        <div class="installer-wrapper">
            <div class="wrapper">
                <div class="left-sidebar clearfix">
                    <ul class="list-inline">
                        <li class="{{ request()->is('install/pre-installation') ? 'active' : 'complete' }}">
                            Pre-Installation
                        </li>

                        <li class="{{ request()->is('install/configuration') ? 'active' : '' }} {{ request()->is('install/complete') ? 'complete' : '' }}">
                            Configuration
                        </li>

                        <li class="{{ request()->is('install/complete') ? 'complete' : '' }}">
                            Complete
                        </li>
                    </ul>
                </div>

                <div class="content-wrapper clearfix">
                    <div class="content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
        @stack('scripts')
    </body>
</html>
