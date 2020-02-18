<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white"><i class="fa fa-book"></i> Tópicos recentes
            <a class="text-white float-right" data-action="collapse"><i class="ti-minus"></i></a>
        </h5>
    </div>
    <div class="card-body collapse show">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="border-top-0">Tópico</th>
                <th class="border-top-0">Fórum</th>
                <th class="border-top-0">Autor(a)</th>
                <th class="border-top-0">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                @if($topic->viewable())
                    <tr>
                        <td>
                            {{ link_to_route('forum.topic', $topic->name, ['topic_id' => $topic->id, 'slug' => $topic->slug]) }}
                        </td>
                        <td>
                            {{ link_to_route('forum.threads', $topic->forum->name, ['forum_id' => $topic->forum->id, 'slug' => $topic->forum->slug]) }}
                        </td>
                        <td>{{ $topic->first_post_username }}</td>
                        <td>{{ $topic->created_at->diffForHumans() }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <p class="text-right font-weight-bold"><a href="{{ route('forum.latest.topics') }}">Leia mais</a></p>
    </div>
</div>
