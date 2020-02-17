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

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = htmlspecialchars($value);
    }

    public function contentHtml()
    {
        return (new BBCode())->parse($this->content, true);
    }

    public function brief($length = 100, $ellipses = true, $strip_html = false)
    {
        $input = $this->content;
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }
        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }
        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);
        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }
        return $trimmed_text;
    }

    public function pageNumber()
    {
        $result = ($this->postNumber() - 1) / 30 + 1;
        return floor($result);
    }

    public function postNumber()
    {
        return $this->topic->postNumberFromId($this->id);
    }

    public function likis($post_id)
    {
        //Count likes and dislike
        return $this->likes()->where('post_id', '=', $post_id)->where('is_like', '=', 1)->count();
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function dislikes($post_id)
    {
        //Count likes and dislike
        return $this->likes()->where('post_id', '=', $post_id)->where('is_dislike', '=', 1)->count();
    }

}
