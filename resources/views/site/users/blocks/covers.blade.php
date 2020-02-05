@if(!empty($member->cover()))
    <div class="col-sm-12 col-lg-12">
        <div class="card vegas-fixed-background" id="member-cover">
            <div class="card-body py-5 my-5">
                <h4 class="text-center text-dark">{{ $member->username }}</h4>
            </div>
        </div>
    </div>
@endif
