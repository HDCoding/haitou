<div class="card">
    <div class="card-header bg-success">
        <h5 class="text-white"> Últimas notícias
            <a class="text-white float-right" data-action="collapse"><i class="ti-minus"></i></a>
        </h5>
    </div>
    <div class="card-body collapse show">
        @forelse($news as $new)
            <p class="card-text">
                {{ link_to_route('read.news', $new->name, ['id' => $new->id, 'slug' => $new->slug]) }}
                &nbsp;
                {{ format_date($new->created_at) }}
            </p>
        @empty
            <p class="card-text">Nenhum conteúdo informativo no momento.</p>
        @endforelse
    </div>
</div>
