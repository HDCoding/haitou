<div class="card-body">
    @forelse($comments as $comment)
        <div class="media pb-1 m-b-3">
            <img src="{{ $comment->user->getAvatar() }}" class="d-block ui-w-40 rounded-circle" alt="avatar">
            <div class="media-body ml-3">
                {{ link_to_route('user.profile', $comment->user->name, ['slug' => $comment->user->slug]) }}
                @if($comment->is_spoiler)
                    <mark class="text-danger">Spoiler!</mark>
                @endif
                <p class="my-1">{{ $comment->content }}</p>
                <div class="clearfix">
                    <span class="float-left text-muted small mr-3">{{ $comment->created_at->format('d/m/Y H:i') }}</span>

                    @if($comment->user_id == auth()->user()->id || auth()->user()->permission->staff_panel)
                        <a href="{{ route('comments.edit', [$comment->id]) }}">
                            <button type="button" class="btn btn-xs btn-outline-primary">
                                <span class="fas fa-pencil-alt" data-toggle="tooltip" title="Editar Comentário"></span>
                            </button>
                        </a>
                    @endif

                    @if($comment->user_id == auth()->user()->id || auth()->user()->permission->staff_panel)
                        <a href="javascript:;"
                           onclick="document.getElementById('comment-del-{{ $comment->id }}').submit();">
                            <button type="submit" class="btn btn-xs btn-outline-danger">
                                <span class="fas fa-times" data-toggle="tooltip" title="Deletar Comentário"></span>
                            </button>
                        </a>
                        {!! Form::open(['url' => 'comments/' . $comment->id, 'method' => 'DELETE', 'id' => 'comment-del-' . $comment->id , 'style' => 'display: none']) !!}
                        {!! Form::close() !!}
                    @endif

                    @if($comment->user_id !== auth()->user()->id)
                        <a href="{{ route('comment.report', [$comment->id]) }}" class="btn btn-xs btn-outline-dark">
                            <span class="fas fa-flag" data-toggle="tooltip" title="Reportar Comentário"></span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @empty
        <p class="text-center push-30">Nenhum comentário no momento. Seja a(o) primeira(o)</p>
        @if(!isset($torrent->allow_comments))
            <p class="text-center push-30 ">Comentários foram desativados para esse torrent.</p>
        @endif
    @endforelse
    {{ $comments->links() }}
</div>
