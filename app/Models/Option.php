<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public $timestamps = false;

    protected $table = 'options';

    protected $casts = [
        'poll_id' => 'int'
    ];

    protected $fillable = [
        'poll_id',
        'name'
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'option_id');
    }

    public function votesCount()
    {
        return $this->hasOne(Vote::class, 'option_id')
            ->selectRaw('option_id, count(*) as count')
            ->groupBy('option_id');
    }

    public function votesPercent($totalVotes = 0)
    {
        $optionVotesCount = $this->votesCount['count'];
        if ($optionVotesCount == 0 && $totalVotes == 0) {
            return 0;
        }
        return round(($optionVotesCount / $totalVotes) * 100);
    }
}
