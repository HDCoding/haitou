<?php

namespace App;

use App\Models\Group;
use App\Models\Invitation;
use App\Models\Log;
use App\Models\Mood;
use App\Models\State;
use App\Models\Vip;
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
        'show_role' => 'bool',
        'show_downloaded' => 'bool',
        'show_uploaded' => 'bool',
        'show_profile' => 'bool',
        'show_profile_points' => 'bool',
        'show_profile_level' => 'bool',
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
        'remember_token'
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
        'show_role',
        'show_downloaded',
        'show_uploaded',
        'show_profile',
        'show_profile_points',
        'show_profile_level',
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

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function mood()
    {
        return $this->belongsTo(Mood::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    public function vips()
    {
        return $this->hasMany(Vip::class, 'user_id');
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
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
            return '<span class="badge badge-outline-warning">Pendente</span>';
        } elseif ($status == 1) {
            return '<span class="badge badge-outline-success">Confirmada(o)</span>';
        } elseif ($status == 2) {
            return '<span class="badge badge-outline-info">Suspensa(o)</span>';
        } elseif ($status == 3) {
            return '<span class="badge badge-outline-danger">Banida(o)</span>';
        } else {
            return "Bugou";
        }
    }

    public function avatar()
    {
        return empty($this->avatar) ? asset('images/avatar.jpg') : urlencode($this->avatar);
    }

    public function points()
    {
        return number_format($this->points);
    }

    public function levelImage()
    {
        $level = $this->getLevel();
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
}
