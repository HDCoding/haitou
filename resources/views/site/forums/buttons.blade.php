<div class="row">
    <div class="col-md-12  mt-3 mb-3">
        <div class="float-left">
            <a href="{{ route('forum') }}" class="btn btn-sm btn-outline-success">
                <i class="ion ion-ios-chatbubbles"></i> Fórum
            </a>
            <a href="{{ route('forum_latest_topics') }}" class="btn btn-sm btn-outline-primary">
                <i class="fa fa-book"></i> Tópicos mais recentes
            </a>
            <a href="{{ route('forum_latest_posts') }}" class="btn btn-sm btn-outline-secondary">
                <i class="fa fa-file"></i> últimas postagens
            </a>
            <a href="{{ route('forum_subscriptions') }}" class="btn btn-sm btn-outline-danger">
                <i class="fa fa-heart"></i> Favoritos
            </a>
            <a href="{{ route('forum.search') }}" class="btn btn-sm btn-outline-dark">
                <i class="fa fa-search"></i> Pesquisar
            </a>
        </div>
        <div class="float-right">
            <strong>Fóruns:</strong> {{ $num_forums }} |
            <strong>Tópicos:</strong> {{ $num_topics }} |
            <strong>Postagens:</strong> {{ $num_posts }}
        </div>
    </div>

</div>

<br>
