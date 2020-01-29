<div class="row">
    <div class="col-md-12 mt-3 mb-3">
        <div class="float-left">
            <a href="{{ route('forum') }}" class="btn btn-sm btn-success btn-rounded">
                <i class="ion ion-ios-chatbubbles"></i> Fórum
            </a>
            <a href="{{ route('forum_latest_topics') }}" class="btn btn-sm btn-primary btn-rounded">
                <i class="fa fa-book"></i> Tópicos recentes
            </a>
            <a href="{{ route('forum_latest_posts') }}" class="btn btn-sm btn-secondary btn-rounded">
                <i class="fa fa-file"></i> Últimas postagens
            </a>
            <a href="{{ route('forum_subscriptions') }}" class="btn btn-sm btn-danger btn-rounded">
                <i class="fa fa-heart"></i> Favoritos
            </a>
            <a href="{{ route('forum.search') }}" class="btn btn-sm btn-dark btn-rounded">
                <i class="fa fa-search"></i> Pesquisar
            </a>
        </div>
        <div class="float-right">
            @if(!empty($num_forums) && !empty($num_topics) && !empty($num_posts))
                <strong>Fóruns:</strong> {{ $num_forums }} |
                <strong>Tópicos:</strong> {{ $num_topics }} |
                <strong>Postagens:</strong> {{ $num_posts }}
            @endif
        </div>
    </div>
</div>
