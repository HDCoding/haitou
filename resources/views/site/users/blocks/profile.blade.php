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
