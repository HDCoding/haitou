<!-- Column -->
<div class="col-lg-4 col-xlg-3 col-md-5">
    <div class="card">
        <div class="card-body">
            <center class="m-t-30">
                <img src="{{ $member->avatar() }}" class="img-rounded" width="150"/>
                <h4 class="card-title m-t-10">{{ $member->username }}</h4>
                <h6 class="card-subtitle m-b-20">{{ $member->groupName() }}</h6>
                <div class="row justify-content-md-center">
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link" data-toggle="tooltip" data-original-title="Ratio">
                            <i class="fas fa-signal"></i>
                            <span class="font-medium">{!! $member->ratio() !!}</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <a href="javascript:void(0)" class="link" data-toggle="tooltip" data-original-title="Pontos">
                            <i class="icon-heart"></i>
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
