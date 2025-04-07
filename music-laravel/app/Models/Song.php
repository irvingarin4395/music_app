<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Song extends Model
{
    use HasFactory;

    public function getAllSong()
    {
        return $this->select(
            'songs.id',
            'songs.title',
            'songs.artist_id',
            'songs.album_id',
            'songs.duration',
            'artists.name AS artist_name',
            'albums.title  AS album_title',
            'albums.release_date'
        )->join(
            'artists',
            'songs.artist_id',
            '=',
            'artists.id'
        )->join(
            'albums',
            'songs.album_id',
            '=',
            'albums.id'
        )->get();
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class, 'album_id', 'id');
    }

    public function getSongById($id)
    {
        return $this->with('aritst')->with('album')->where('songs.id', $id)->first();
    }
}
