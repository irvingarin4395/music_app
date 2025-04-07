<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    public function getAllAlbum()
    {
        return $this->with('artist')->paginate(6)->onEachSide(1);
    }

    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class, 'artist_id', 'id');
    }

    public function song(): HasMany
    {
        return $this->hasMany(Song::class, 'album_id', 'id');
    }

    public function vote(): HasMany
    {
        return $this->hasMany(Vote::class, 'album_id', 'id');
    }

    public function getAlbumSong($id)
    {
        return $this->find($id)->song;
    }

    public function getAlbum($id)
    {
        return $this->with('artist')->where('albums.id', $id)->first();
    }

    public function searchAlbum($search)
    {
        return $this->where('title', 'like', '%' . $search . '%')->with('artist')->paginate(6)->onEachSide(1);
    }

    public function deleteAlbum($id)
    {
        $this->where('id', $id)->delete();
    }
}
