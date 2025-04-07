<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist extends Model
{
    use HasFactory;

    public function getAllArtist()
    {
        return $this->paginate(12);
    }

    public function getArtist($id)
    {
        return $this->find($id);
    }

    public function song(): HasMany
    {
        return $this->hasMany(Song::class, 'artist_id', 'id');
    }

    public function album(): HasMany
    {
        return $this->hasMany(Album::class, 'artist_id', 'id');
    }

    public function getSongByArtist($id)
    {
        return $this->find($id)->song;
    }

    public function getAlbumByArtist($id)
    {
        return $this->find($id)->album;
    }
}
