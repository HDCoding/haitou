<div class="comment-widgets scrollable" style="height:560px;">
    @forelse($comments as $comment)
    <!-- Comment Row -->
    <div class="d-flex flex-row comment-row">
        <div class="p-2">
            <img src="{{ $comment->user->avatar() }}" alt="user" width="50" class="rounded-circle">
        </div>
        <div class="comment-text active w-100">
            <h6 class="font-medium">
                {{ link_to_route('user.profile', $comment->username, ['slug' => $comment->user->slug]) }}
            </h6>
            <span class="m-b-15 d-block">
                {{ $comment->content }}
            </span>
            <div class="comment-footer">
                <span class="text-muted float-right">
                    {{ format_date_time($comment->created_at) }}
                </span>
                @if($comment->is_spoiler)
                    <span class="label label-success label-rounded">Spoiler!</span>
                @endif
                <span class="action-icons active">
                    @if($comment->user_id == auth()->user()->id)
                        <a href="{{ route('comments.edit', [$comment->id]) }}">
                            <i class="ti-pencil-alt" data-toggle="tooltip" title="Editar Comentário"></i>
                        </a>
                    @endif
                    @if($comment->user_id == auth()->user()->id)
                        <a href="javascript:;" onclick="document.getElementById('comment-del-{{ $comment->id }}').submit();">
                            <i class="icon-close" data-toggle="tooltip" title="Deletar Comentário"></i>
                        </a>
                        {!! Form::open(['url' => 'comments/' . $comment->id, 'method' => 'DELETE', 'id' => 'comment-del-' . $comment->id , 'style' => 'display: none']) !!}
                        {!! Form::close() !!}
                    @endif
                    @if($comment->user_id !== auth()->user()->id)
                        <a href="{{ route('comment.report', [$comment->id]) }}">
                            <i class="fas fa-flag text-dark" data-toggle="tooltip" title="Reportar Comentário"></i>
                        </a>
                    @endif
                </span>
            </div>
        </div>
    </div>
    <!-- Comment Row -->
    @empty
        <p class="text-center push-30">Nenhum comentário no momento. Seja a(o) primeira(o)</p>
        @if(isset($torrent->allow_comments) AND $torrent->allow_comments == false)
            <p class="text-center push-30">Comentários foram desativados para esse torrent.</p>
        @endif
    @endforelse
</div>
<div class="m-t-40">
    {{ $comments->links() }}
</div>

