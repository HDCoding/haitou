<div class="card">
    <div class="card-header bg-secondary">
        <h5 class="text-white"><i class="fa fa-file"></i> Últimas postagens</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="border-top-0">Post</th>
                <th class="border-top-0">Tópico</th>
                <th class="border-top-0">Autor(a)</th>
                <th class="border-top-0">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                @if ($post->topic->viewable())
                    <tr>
                        <td>
                            <a href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}?page={{ $post->pageNumber() }}#post-{{ $post->id }}">
                                {{ preg_replace('#\[[^\]]+\]#', '', str_limit(htmlspecialchars_decode($post->content), 65)) }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}">
                                {{ $post->topic->name }}
                            </a>
                        </td>
                        <td>{{ $post->post_username }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <p class="text-right font-weight-bold"><a href="{{ route('forum_latest_posts') }}">Leia mais</a></p>
    </div>
</div>
