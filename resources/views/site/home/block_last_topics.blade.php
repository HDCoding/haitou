<div class="card">
    <div class="card-header bg-primary">
        <h5 class="text-white"><i class="fa fa-book"></i> Tópicos recentes</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="border-top-0">Fórum</th>
                <th class="border-top-0">Tópico</th>
                <th class="border-top-0">Autor(a)</th>
                <th class="border-top-0">Data</th>
            </tr>
            </thead>
            <tbody>
            @foreach($topics as $topic)
                @if($topic->viewable())
                    <tr>
                        <td>
                            <a href="{{ route('forum.topics', ['id' => $topic->forum->id, 'slug' => $topic->slug]) }}">
                                {{ $topic->forum->name }}
                            </a>
                        </td>
                        <td>
                            <a href="{{ route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]) }}">
                                {{ $topic->name }}
                            </a>
                        </td>
                        <td>{{ $topic->first_post_username }}</td>
                        <td>{{ $topic->created_at->diffForHumans() }}</td>
                    </tr>
                @endif
            @endforeach
            </tbody>
        </table>
        <p class="text-right font-weight-bold"><a href="{{ route('forum_latest_topics') }}">Leia mais</a></p>
    </div>
</div>
