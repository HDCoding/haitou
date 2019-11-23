@extends('layouts.dashboard')

@section('subtitle', 'Profile')

@section('content')

    <!-- Header -->
    <div class="container-m-nx container-m-ny bg-white mb-4">
        <div class="media col-md-10 col-lg-8 col-xl-7 py-5 mx-auto">
            <img src="{{ $member->getAvatar() }}" alt class="d-block ui-w-100 rounded-circle">
            <div class="media-body ml-5">
                <h4 class="font-weight-bold mb-4">{{ $member->name }}</h4>

                <div class="text-muted mb-4">
                    {{ $member->info }}
                </div>

                <a href="javascript:void(0)" class="d-inline-block text-body">
                    <span class="text-muted">Grupo:</span>
                    <strong>{{ $member->role->name }}</strong>
                </a>
                <a href="javascript:void(0)" class="d-inline-block text-body ml-3">
                    <span class="text-muted">Membro desde:</span>
                    <strong>{{ $member->activated_at->format('d/m/Y') }}</strong>
                </a>
            </div>
        </div>
        <hr class="m-0">
    </div>
    <!-- Header -->

    <div class="row">
        <div class="col">

            <!-- Info -->
            <div class="card mb-4">
                <div class="card-body">

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Aniversário:</div>
                        <div class="col-md-9">{{ $member->birthday->format('d/m') }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Estado:</div>
                        <div class="col-md-9">{{ $member->state->name }}</div>
                    </div>

                    <h6 class="my-3">Up/Down</h6>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Upload:</div>
                        <div class="col-md-9">{{ $member->getUploaded() }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Download:</div>
                        <div class="col-md-9">{{ $member->getDownloaded() }}</div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Ratio:</div>
                        <div class="col-md-9">{{ $member->getRatio() }}</div>
                    </div>

                    <h6 class="my-3">XP</h6>

                    <div class="row mb-2">
                        <div class="col-md-3 text-muted">Pontos:</div>
                        <div class="col-md-9">{{ $member->getPoints() }}</div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 text-muted">Level:</div>
                        <div class="col-md-9">{{ $member->getLevel() }}</div>
                    </div>

                </div>
                <div class="card-footer text-center p-0">
                    <div class="row no-gutters row-bordered row-border-light">
                        <a href="javascript:void(0)" class="d-flex col flex-column text-body py-3">
                            <div class="font-weight-bold">{{ $member->forum_posts()->count() }}</div>
                            <div class="text-muted small">Posts</div>
                        </a>
                        <a href="javascript:void(0)" class="d-flex col flex-column text-body py-3">
                            <div class="font-weight-bold">{{ $member->unlockedAchievements()->count() }}</div>
                            <div class="text-muted small">Conquistas</div>
                        </a>
                        <a href="javascript:void(0)" class="d-flex col flex-column text-body py-3">
                            <div class="font-weight-bold">{{ $member->comments()->count() }}</div>
                            <div class="text-muted small">Comentários</div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- / Info -->

        </div>
        <div class="col-xl-4">

            <!-- Side info -->
            <div class="card mb-4">
                <div class="card-body">

{{--                            @if(!auth()->user()->isFriendWith($member))--}}
                            <a href="{{ route('befriend', [$member->id]) }}" class="btn btn-sm btn-primary rounded-pill">+&nbsp; Adcionar</a>
{{--                            @elseif(auth()->user()->isFriendWith($member, 0))--}}
{{--                                <a href="{{ route('unfriend', [$member->id]) }}" class="btn btn-sm btn-primary rounded-pill">- Cancelar</a>--}}
{{--                            @elseif(auth()->user()->isFriendWith($member))--}}
{{--                                <a href="#" class="btn btn-sm btn-success rounded-pill">Amigos</a>--}}
{{--                            @else--}}
{{--                                Err--}}
{{--                            @endif--}}

                    &nbsp;
                    <a href="{{ route('user.report', [$member->id]) }}" target="_blank" class="btn btn-sm btn-default rounded-pill">
                        <span class="ion ion-ios-flag"></span> Reportar
                    </a>
                    &nbsp;
{{--                        @if(auth()->user()->isBlockedBy($member))--}}
{{--                            <a href="{{ route('unblockFriend', [$member->id]) }}" class="btn btn-sm btn-danger rounded-pill">-&nbsp; Desbloquear</a>--}}
{{--                        @else--}}
                        <a href="{{ route('blockFriend', [$member->id]) }}" class="btn btn-sm btn-danger rounded-pill">+&nbsp; Bloquear</a>
{{--                        @endif--}}

                </div>
                <hr class="border-light m-0">
                <div class="card-body">
                    <p class="mb-2">
                        <img src="{{ $member->mood->getImage() }}" alt="{{ $member->mood->getName() }}" title="{{ $member->mood->getName() }}">
                    </p>
                </div>
                <hr class="border-light m-0">
                <div class="card-body">
                    @if(!empty($member->user_settings->facebook))
                        <a href="{{ $member->user_settings->facebook }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-facebook ui-w-30 text-center text-facebook"></i> Facebook
                        </a>
                    @endif
                    @if(!empty($member->user_settings->twitter))
                        <a href="{{ $member->user_settings->twitter }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-twitter ui-w-30 text-center text-twitter"></i> Twitter
                        </a>
                    @endif
                    @if(!empty($member->user_settings->googleplus))
                        <a href="{{ $member->user_settings->googleplus }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-googleplus ui-w-30 text-center text-google"></i> Google Plus
                        </a>
                    @endif
                    @if(!empty($member->user_settings->linkedin))
                        <a href="{{ $member->user_settings->linkedin }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-linkedin ui-w-30 text-center text-linkedin"></i> LinkedIn
                        </a>
                    @endif
                    @if(!empty($member->user_settings->instagram))
                        <a href="{{ $member->user_settings->instagram }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-instagram ui-w-30 text-center text-instagram"></i> Instagram
                        </a>
                    @endif
                    @if(!empty($member->user_settings->pinterest))
                        <a href="{{ $member->user_settings->pinterest }}" class="d-block text-body mb-2" target="_blank">
                            <i class="ion ion-logo-pinterest ui-w-30 text-center text-pinterest"></i> Pinterest
                        </a>
                    @endif
                </div>
            </div>
            <!-- / Side info -->

            <!-- Friends -->
            <div class="card mb-4">
                <div class="card-header with-elements">
                <span class="card-header-title">Amigos &nbsp;
                  <small class="text-muted">{{ $friends_total }}</small>
                </span>
                    <div class="card-header-elements ml-md-auto">
                        <a href="{{ route('user.friends', ['slug' => $member->slug]) }}"
                           class="btn btn-default md-btn-flat btn-xs">Mostrar todos</a>
                    </div>
                </div>
                <div class="row no-gutters row-bordered row-border-light">
                    @foreach($friends as $friend)
                        <a href="{{ route('user.profile', ['slug' => $friend->friends->slug]) }}"
                           class="d-flex col-4 col-sm-3 col-md-4 flex-column align-items-center text-body py-3 px-2">
                            <img src="{{ $friend->friends->getAvatar() }}" alt="{{ $friend->friends->name }}"
                                 class="d-block ui-w-40 rounded-circle mb-2">
                            <div class="text-center small">{{ $friend->friends->name }}</div>
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- / Friends -->

        </div>
    </div>

@endsection
