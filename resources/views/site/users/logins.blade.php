@extends('layouts.dashboard')

@section('title', 'Logins')

@section('css')
    <link href="{{ secure_asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('user.profile', ['slug' => $member->slug]) }}">{{ $member->username }}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Logins</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
        @include('site.users.blocks.covers')

        @include('site.users.blocks.left')

        <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Urls -->
                @include('site.users.blocks.urls')
                <!-- Urls -->
                    @include('site.users.blocks.logins')
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>

@endsection

@section('scripts')
    <!-- VegasJS -->
    <script src="{{ secure_asset('vendor/vegas/vegas.js') }}"></script>

    @if(!empty($member->cover()))
        <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
            $(function() {
                // Fixed bg
                $('#member-cover').vegas({
                    overlay: false,
                    timer: false,
                    shuffle: true,
                    slides: [
                        { src: "{{ $member->cover() }}" },
                    ],
                    transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                    animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
                });
            });
        </script>
    @endif

@endsection
