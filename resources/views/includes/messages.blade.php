@if (!empty($info))
    <div class="alert alert-info alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $info }}
    </div>
@endif

@if (!empty($warning))
    <div class="alert alert-warning alert-dismissible fade show text-center">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $warning }}
    </div>
@endif

@if (!empty($danger))
    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $danger }}
    </div>
@endif
