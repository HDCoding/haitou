<?php

namespace App\Models;

use App\Helpers\BBCode;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $table = 'posts';

    protected $casts = [
        'forum_id' => 'int',
        'topic_id' => 'int',
        'user_id' => 'int'
    ];

    protected $fillable = [
        'forum_id',
        'topic_id',
        'user_id',
        'post_username',
        'content'
    ];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'post_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function contentHtml()
    {
        return (new BBCode())->parse($this->content, true);
    }

    public function postNumber()
    {
        return $this->topic()->postNumberFromId($this->id);
    }

    public function getPageNumber()
    {
        $result = ($this->getPostNumber() - 1) / 30 + 1;
        $result = floor($result);
        return $result;
    }

    public function likis($post_id)
    {
        //Count likes and dislike
        return $this->likes()->where('post_id', '=', $post_id)->where('is_like', '=', 1)->count();
    }

    public function dislikes($post_id)
    {
        //Count likes and dislike
        return $this->likes()->where('post_id', '=', $post_id)->where('is_dislike', '=', 1)->count();
    }

}
