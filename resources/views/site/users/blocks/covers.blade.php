@if(!empty($member->cover()))
    <div class="col-sm-12 col-lg-12">
        <div class="card vegas-fixed-background" id="member-cover">
            <div class="card-body py-home">
                <h2 class="text-center text-info">{{ $member->username }}</h2>
            </div>
        </div>
    </div>
@endif
