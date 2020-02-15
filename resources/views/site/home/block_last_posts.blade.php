<div class="card">
    <div class="card-header bg-secondary">
        <h5 class="text-white"><i class="fa fa-file"></i> Últimas postagens
            <a class="text-white float-right" data-action="collapse"><i class="ti-minus"></i></a>
        </h5>
    </div>
    <div class="card-body collapse show">
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
                            <a href="{{ route('forum.topic', ['topic_id' => $post->topic->id, 'slug' => $post->topic->slug]) }}?page={{ $post->pageNumber() }}#post-{{ $post->id }}">
                                {{ preg_replace('#\[[^\]]+\]#', '', str_limit(htmlspecialchars_decode($post->content), 100)) }}
                            </a>
                        </td>
                        <td>
                            {{ link_to_route('forum.topic', $post->topic->name, ['topic_id' => $post->topic->id, 'slug' => $post->topic->slug]) }}
                        </td>
                        <td>{{ $post->post_username }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <p class="text-right font-weight-bold"><a href="{{ route('forum.latest.posts') }}">Leia mais</a></p>
    </div>
</div>
