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
                                 alt="{{ $achievement->details->name }}" width="90px">
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</div>
