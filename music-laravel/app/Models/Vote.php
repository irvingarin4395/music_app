<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vote extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'album_id', 'vote_type'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function getVoteByAlbum() {}

    public function getVote($user_id, $request)
    {
        return $this->where('user_id', $user_id)->where('album_id', $request->album_id)->first();
    }
}
