@extends('layouts.dashboard')

@section('title', 'Perfil')

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">{{ $member->username }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            @if(!empty($member->cover()))
            <div class="col-sm-12 col-lg-12">
                <div class="card vegas-fixed-background" id="member-cover">
                    <div class="card-body py-5 my-5">
                        <h4 class="text-center text-dark">{{ $member->username }}</h4>
                    </div>
                </div>
            </div>
            @endif
            <!-- Column -->
            <div class="col-lg-4 col-xlg-3 col-md-5">
                <div class="card">
                    <div class="card-body">
                        <center class="m-t-30">
                            <img src="{{ $member->avatar() }}" class="rounded-circle" width="150"/>
                            <h4 class="card-title m-t-10">{{ $member->username }}</h4>
                            <h6 class="card-subtitle m-b-20">{{ $member->groupName() }}</h6>
                            <div class="row justify-content-md-center">
                                <div class="col-4">
                                    <a href="javascript:void(0)" class="link">
                                        <i class="icon-people"></i>
                                        <font class="font-medium">{{ $member->ratio() }}</font>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="javascript:void(0)" class="link">
                                        <i class="icon-picture"></i>
                                        <font class="font-medium">{{ $member->points() }}</font>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="{{ route('user.report', [$member->id]) }}" target="_blank" class="text-dark">
                                        <i class="ion ion-ios-flag"></i> Reportar
                                    </a>
                                </div>
                            </div>
                        </center>
                    </div>
                    <div>
                        <hr>
                    </div>
                    <div class="card-body">
                        <small class="text-muted">Level</small>
                        <h6>{{ $member->level() }}</h6>
                        <small class="text-muted p-t-30 db">Posts</small>
                        <h6>{{ $member->posts()->count() }}</h6>
                        <small class="text-muted p-t-30 db">Conquistas</small>
                        <h6>{{ $member->unlockedAchievements()->count() }}</h6>
                        <small class="text-muted p-t-30 db">Comentários</small>
                        <h6>{{ $member->comments()->count() }}</h6>
                        <small class="text-muted p-t-30 db">Perfil Social</small>
                        <div class="row m-l-0">
                        @if(!empty($member->facebook))
                            <a href="{{ hideref($member->facebook) }}" class="btn btn-circle btn-facebook m-r-10" target="_blank">
                                <i class="ion ion-logo-facebook"></i>
                            </a>
                        @endif
                        @if(!empty($member->twitter))
                            <a href="{{ hideref($member->twitter) }}" class="btn btn-circle btn-twitter m-r-10" target="_blank">
                                <i class="ion ion-logo-twitter"></i>
                            </a>
                        @endif
                        @if(!empty($member->linkedin))
                            <a href="{{ hideref($member->linkedin) }}" class="btn btn-circle btn-linkedin m-r-10" target="_blank">
                                <i class="ion ion-logo-linkedin"></i>
                            </a>
                        @endif
                        @if(!empty($member->instagram))
                            <a href="{{ hideref($member->instagram) }}" class="btn btn-circle btn-instagram m-r-10" target="_blank">
                                <i class="ion ion-logo-instagram"></i>
                            </a>
                        @endif
                        @if(!empty($member->pinterest))
                            <a href="{{ hideref($member->pinterest) }}" class="btn btn-circle btn-pinterest m-r-10" target="_blank">
                                <i class="ion ion-logo-pinterest"></i>
                            </a>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-8 col-xlg-9 col-md-7">
                <div class="card">
                    <!-- Tabs -->
                    <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#last-month" role="tab"
                               aria-controls="pills-profile" aria-selected="false">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " id="pills-timeline-tab" data-toggle="pill" href="#current-month"
                               role="tab" aria-controls="pills-timeline" aria-selected="true">Conquistas</a>
                        </li>
                    </ul>
                    <!-- Tabs -->
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="last-month" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Membro desde</strong>
                                        <br>
                                        <p class="text-muted">{{ format_date($member->activated_at) }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Estado</strong>
                                        <br>
                                        <p class="text-muted">{{ $member->state->name }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6 b-r">
                                        <strong>Upload</strong>
                                        <br>
                                        <p class="text-muted">{{ $member->uploaded() }}</p>
                                    </div>
                                    <div class="col-md-3 col-xs-6">
                                        <strong>Download</strong>
                                        <br>
                                        <p class="text-muted">{{ $member->downloaded() }}</p>
                                    </div>
                                </div>
                                <hr>
                                <h5 class="m-t-30">Humor</h5>
                                <p class="m-t-30">
                                    <img src="{{ $member->mood->image() }}" alt="{{ $member->mood->name() }}" title="{{ $member->mood->name() }}">
                                </p>
                                <hr>
                                <h5 class="m-t-30">Info</h5>
                                <p>
                                    {{ $member->info }}
                                </p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="current-month" role="tabpanel" aria-labelledby="pills-timeline-tab">
                            <div class="card-body">
                                <div class="row m-l-10">
                                    @foreach($member->achievements as $achievement)
                                        <div class="m-d-3">
                                            @if($achievement->isUnlocked())
                                                <div class="text-center">
                                                    <img src="{{ asset('images/achievements/' . strtolower(str_replace(' ', '', $achievement->details->name) . '.png')) }}"
                                                         data-toggle="tooltip"
                                                         data-original-title="{{ $achievement->details->name }}"
                                                         alt="{{ $achievement->details->name }}" width="40px">
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
    </div>

@endsection

@section('scripts')
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>

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
