<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use Sluggable;

    protected $table = 'reports';

    protected $casts = [
        'user_id' => 'int',
        'staff_id' => 'int',
        'calendar_id' => 'int',
        'comment_id' => 'int',
        'member_id' => 'int',
        'post_id' => 'int',
        'torrent_id' => 'int',
        'report_type' => 'int',
        'is_solved' => 'bool'
    ];

    protected $fillable = [
        'user_id',
        'staff_id',
        'calendar_id',
        'comment_id',
        'member_id',
        'post_id',
        'torrent_id',
        'report_type',
        'name',
        'slug',
        'reason',
        'solution',
        'is_solved'
    ];

    public function calendar()
    {
        return $this->belongsTo(Calendar::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function torrent()
    {
        return $this->belongsTo(Torrent::class);
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function type(): string
    {
        $report_type = $this->report_type;

        if ($report_type == 0) {
            return '<span class="badge badge-default">Torrent</span>';
        } elseif ($report_type == 1) {
            return '<span class="badge badge-primary">Fórum Post</span>';
        } elseif ($report_type == 2) {
            return '<span class="badge badge-success">Membro</span>';
        } elseif ($report_type == 3) {
            return '<span class="badge badge-info">Comentário</span>';
        } else {
            return '<span class="badge badge-warning">Calendário</span>';
        }
    }

    public function solved()
    {
        return $this->is_solved ? '<span class="badge badge-success">Sim</span>' : '<span class="badge badge-danger">Não</span>';
    }

    public function reasonHtml()
    {
        return (new BBCode())->parse($this->reason, true);
    }

    public function solutionHtml()
    {
        return (new BBCode())->parse($this->solution, true);
    }
}
