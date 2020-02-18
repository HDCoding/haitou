<?php

namespace App;

use App\Helpers\BBCode;
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
use Carbon\Carbon;
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
        'disabled_at',
        'last_action'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'passkey',
        'status',
        'last_action'
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
        'last_action',
        'activated_at',
        'disabled_at'
    ];

    public static function updateOfflinePoints($user_id, $points)
    {
        $user = self::where('id', '=', $user_id)->first();
        $user->points += $points;
        $user->experience += $points;
        $user->save();
    }

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
        $expire_at = Carbon::now()->addMinutes(20);

        $flag = cache()->remember('user_flag_'.$this->id, $expire_at, function () {
            return asset('images/states/' . $this->state->flag);
        });
        return $flag;
    }

    public function downloaded()
    {
        $expire_at = Carbon::now()->addMinutes(20);

        $down = cache()->remember('user_down_'.$this->id, $expire_at, function () {
            return make_size($this->downloaded);
        });
        return $down;
    }

    public function uploaded()
    {
        $expire_at = Carbon::now()->addMinutes(20);

        $up = cache()->remember('user_up_'.$this->id, $expire_at, function () {
            return make_size($this->uploaded);
        });
        return $up;
    }

    public function ratio()
    {
        $expire_at = Carbon::now()->addMinutes(5);

        $ratio = cache()->remember('user_ratio_'.$this->id, $expire_at, function () {
            if ($this->uploaded == 0 && $this->downloaded == 0) {
                return number_format(1, 2);
            } elseif ($this->uploaded > 0 && $this->downloaded > 0) {
                return (float)number_format($this->uploaded / $this->downloaded, 2);
            } else {
                return '<i class="fas fa-infinity"></i>';
            }
        });
        return $ratio;
    }

    public function status()
    {
        $status = $this->status;

        if ($status == 1) {
            return '<span class="badge badge-pill badge-info">Pendente</span>';
        } elseif ($status == 2) {
            return '<span class="badge badge-pill badge-success">Confirmada(o)</span>';
        } elseif ($status == 3) {
            return '<span class="badge badge-pill badge-warning">Suspensa(o)</span>';
        } elseif ($status == 4) {
            return '<span class="badge badge-pill badge-danger">Banida(o)</span>';
        } else {
            return 'Bugou';
        }
    }

    public function avatar()
    {
        return empty($this->avatar) ? asset('images/no-avatar.jpg') : url('storage/avatars/' . $this->avatar);
    }

    public function cover()
    {
        return empty($this->cover) ? asset('images/no-cover.jpg') : url('storage/covers/' . $this->cover);
    }

    public function points()
    {
        $expire_at = Carbon::now()->addMinutes(5);

        $points = cache()->remember('usr_pts_'.$this->id, $expire_at, function () {
            return $this->points > 0 ? number_format($this->points, 0, ',', '.') : 0;
        });
        return $points;
    }

    public function levelImage()
    {
        $expire_at = Carbon::now()->addMinutes(20);

        $lvl = cache()->remember('img_lvl_'.$this->id, $expire_at, function () {
            $level = $this->level();
            return asset("images/ranks/{$level}.png");
        });
        return $lvl;
    }

    public function level()
    {
        $expire_at = Carbon::now()->addMinutes(20);

        //only works until level 999 = equal 999000 in integer
        $exp = cache()->remember('user_exp_'.$this->id, $expire_at, function () {
            $experience = $this->experience;
            return $experience < 1000 ? 0 : floor(number_format($experience));
        });
        return $exp;
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

    public function groupName()
    {
        $expire_at = Carbon::now()->addMinutes(20);

        // User group
        $user_group = cache()->remember('user_group_'.$this->id, $expire_at, function () {
            return $this->group()->select('name')->pluck('name')->first();
        });
        return $user_group;
    }

    public function isSubscribed($topic_id)
    {
        return (bool)$this->subscriptions()->where('topic_id', '=', $topic_id)->first('id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'user_id');
    }

    /**
     * Gets the amount of torrents a user seeds
     */
    public function seeding()
    {
        return $this->peers()->where('user_id', '=', $this->id)
            ->where('is_seeder', '=', true)
            ->distinct('user_id')
            ->count();
    }

    public function peers()
    {
        return $this->hasMany(Peer::class, 'user_id');
    }

    /**
     * Gets the amount of torrents a user seeds
     */
    public function leeching()
    {
        return $this->peers()->where('user_id', '=', $this->id)
            ->where('remaining', '>', '0')
            ->distinct('user_id')
            ->count();
    }

    /**
     * Gets the amount of torrents a user seeds
     */
    public function uploads()
    {
        return $this->torrents()->where('user_id', '=', $this->id)->count();
    }

    public function torrents()
    {
        return $this->hasMany(Torrent::class, 'user_id');
    }

    public function signature()
    {
        return (new BBCode())->parse($this->signature, true);
    }

    public function topicEmailNotification($topic_id)
    {
        return (bool)$this->subscriptions()
            ->where('topic_id', '=', $topic_id)
            ->where('email', '=', true)
            ->first();
    }

    public function topicNotification($topic_id)
    {
        return (bool)$this->subscriptions()
            ->where('topic_id', '=', $topic_id)
            ->where('notify', '=', true)
            ->first();
    }

}
