<?php

namespace App;

use App\Models\Attachment;
use App\Models\Bookmark;
use App\Models\Calendar;
use App\Models\Cheater;
use App\Models\Comment;
use App\Models\Complete;
use App\Models\Donation;
use App\Models\FailedLogin;
use App\Models\Fansub;
use App\Models\Historic;
use App\Models\Invitation;
use App\Models\Like;
use App\Models\Log;
use App\Models\Login;
use App\Models\Lottery;
use App\Models\LotteryWinner;
use App\Models\Moderate;
use App\Models\Moderator;
use App\Models\Mood;
use App\Models\News;
use App\Models\Note;
use App\Models\Peer;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Rating;
use App\Models\Report;
use App\Models\State;
use App\Models\Subscription;
use App\Models\Thank;
use App\Models\Topic;
use App\Models\Torrent;
use App\Models\UserBonus;
use App\Models\Vip;
use App\Models\Vote;
use App\Traits\HasPermissions;
use App\Traits\UsersOnline;
use Cviebrock\EloquentSluggable\Sluggable;
use Gstt\Achievements\Achiever;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Achiever;
    use HasApiTokens;
    use Notifiable;
    use Sluggable;
    use UsersOnline;
    use HasPermissions;

    protected $table = 'users';

    protected $casts = [
        'mood_id' => 'int',
        'group_id' => 'int',
        'state_id' => 'int',
        'status' => 'int',
        'uploaded' => 'int',
        'downloaded' => 'int',
        'points' => 'int',
        'experience' => 'int',
        'reputation' => 'int',
        'invites' => 'int',
        'max_slots' => 'int',
        'is_warned' => 'bool',
        'is_donor' => 'bool',
        'birth_gifted' => 'bool',
        'readed_rules' => 'bool',
        'time_online' => 'int',
        'views' => 'int',
        'show_achievements' => 'bool',
        'show_mood' => 'bool',
        'show_state' => 'bool',
        'show_group' => 'bool',
        'show_downloaded' => 'bool',
        'show_uploaded' => 'bool',
        'show_profile' => 'bool',
        'show_profile_points' => 'bool',
        'show_profile_level' => 'bool',
        'show_profile_avatar' => 'bool',
        'show_profile_cover' => 'bool',
        'show_profile_info' => 'bool',
        'show_profile_title' => 'bool',
        'show_profile_signature' => 'bool',
        'show_profile_birthday' => 'bool',
        'show_profile_social_links' => 'bool',
        'show_profile_friends' => 'bool',
        'show_profile_warning' => 'bool',
        'show_forum_signatures' => 'bool',
        'receive_email' => 'bool',
        'torrents_per_page' => 'int',
        'topics_per_page' => 'int',
        'posts_per_page' => 'int'
    ];

    protected $dates = [
        'birthday',
        'activated_at',
        'disabled_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'passkey',
        'status'
    ];

    protected $fillable = [
        'mood_id',
        'group_id',
        'state_id',
        'username',
        'slug',
        'email',
        'password',
        'status',
        'uploaded',
        'downloaded',
        'points',
        'experience',
        'reputation',
        'invites',
        'max_slots',
        'passkey',
        'avatar',
        'cover',
        'info',
        'title',
        'signature',
        'birthday',
        'is_warned',
        'is_donor',
        'birth_gifted',
        'readed_rules',
        'time_online',
        'css_style',
        'code',
        'views',
        'show_achievements',
        'show_mood',
        'show_state',
        'show_group',
        'show_downloaded',
        'show_uploaded',
        'show_profile',
        'show_profile_points',
        'show_profile_level',
        'show_profile_avatar',
        'show_profile_cover',
        'show_profile_info',
        'show_profile_title',
        'show_profile_signature',
        'show_profile_birthday',
        'show_profile_social_links',
        'show_profile_friends',
        'show_profile_warning',
        'show_forum_signatures',
        'receive_email',
        'facebook',
        'twitter',
        'linkedin',
        'instagram',
        'pinterest',
        'torrents_per_page',
        'topics_per_page',
        'posts_per_page',
        'remember_token',
        'activated_at',
        'disabled_at'
    ];

    public function mood()
    {
        return $this->belongsTo(Mood::class, 'mood_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function user_bonus()
    {
        return $this->hasMany(UserBonus::class, 'user_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'user_id');
    }

    public function cheaters()
    {
        return $this->hasMany(Cheater::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'user_id');
    }

    public function failed_logins()
    {
        return $this->hasMany(FailedLogin::class, 'user_id');
    }

    public function fansubs()
    {
        return $this->belongsToMany(Fansub::class, 'fansub_users')
            ->withPivot('id', 'job', 'is_admin')
            ->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'user_id');
    }

    public function moderators()
    {
        return $this->hasMany(Moderator::class, 'user_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function historics()
    {
        return $this->hasMany(Historic::class, 'user_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'user_id');
    }

    public function logins()
    {
        return $this->hasMany(Login::class, 'user_id');
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    public function lotteries()
    {
        return $this->belongsToMany(Lottery::class, 'lottery_users')
            ->withPivot('id', 'numbers')
            ->withTimestamps();
    }

    public function lottery_winners()
    {
        return $this->hasMany(LotteryWinner::class, 'user_id');
    }

    public function moderates()
    {
        return $this->hasMany(Moderate::class);
    }

    public function news()
    {
        return $this->hasMany(News::class, 'user_id');
    }

    public function peers()
    {
        return $this->hasMany(Peer::class, 'user_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'user_id');
    }

    public function polls()
    {
        return $this->hasMany(Poll::class, 'user_id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function thanks()
    {
        return $this->hasMany(Thank::class, 'user_id');
    }

    public function completes()
    {
        return $this->hasMany(Complete::class, 'user_id');
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class, 'user_id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'user_id');
    }

    public function vips()
    {
        return $this->hasMany(Vip::class, 'user_id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username'
            ]
        ];
    }

    public function flag()
    {
        return asset('images/states/' . $this->state->flag);
    }

    public function downloaded()
    {
        return make_size($this->downloaded);
    }

    public function uploaded()
    {
        return make_size($this->uploaded);
    }

    public function ratio()
    {
        if ($this->uploaded == 0 && $this->downloaded == 0) {
            return number_format(1, 2);
        } elseif ($this->uploaded > 0 && $this->downloaded > 0) {
            return (float)number_format($this->uploaded / $this->downloaded, 2);
        } else {
            return "Info";
        }
    }

    public function status()
    {
        $status = $this->status;

        if ($status == 0) {
            return '<span class="badge badge-pill badge-warning">Pendente</span>';
        } elseif ($status == 1) {
            return '<span class="badge badge-pill badge-success">Confirmada(o)</span>';
        } elseif ($status == 2) {
            return '<span class="badge badge-pill badge-info">Suspensa(o)</span>';
        } elseif ($status == 3) {
            return '<span class="badge badge-pill badge-danger">Banida(o)</span>';
        } else {
            return "Bugou";
        }
    }

    public function avatar()
    {
        return empty($this->avatar) ? asset('images/avatar.jpg') : $this->avatar;
    }

    public function cover()
    {
        return empty($this->cover) ? null : $this->cover;
    }

    public function points()
    {
        return $this->points > 0 ? number_format($this->points) : 0;
    }

    public function levelImage()
    {
        $level = $this->level();
        return asset("images/ranks/{$level}.png");
    }

    public function level()
    {
        //only works until level 999 = equal 999000 in integer
        $experience = $this->experience;
        return $experience < 1000 ? 0 : floor(number_format($experience));
    }

    public function updatePoints($points)
    {
        if (auth()->check()) {
            $user = auth()->user();
            $user->points += $points;
            $user->experience += $points;
            $user->save();
        }
    }

    public static function updateOfflinePoints($user_id, $points)
    {
        $user = self::where('id', '=', $user_id)->first();
        $user->points += $points;
        $user->experience += $points;
        $user->save();
    }

    public function groupName()
    {
        return $this->group()->select('name')->pluck('name')->first();
    }

    public function isSubscribed(string $type, $topic_id)
    {
        if ($type == 'topic') {
            return (bool)$this->subscriptions()->where('topic_id', '=', $topic_id)->first(['id']);
        }
        return (bool)$this->subscriptions()->where('forum_id', '=', $topic_id)->first(['id']);
    }

}
