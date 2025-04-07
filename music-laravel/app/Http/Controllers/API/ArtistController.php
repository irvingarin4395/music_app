<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    protected $artistRecord;

    public function __construct(Artist $artist)
    {
        $this->artistRecord = $artist;
    }

    public function index()
    {
        $allArtist = $this->artistRecord->getAllArtist();
        return $allArtist;
    }

    public function get($id)
    {
        $artist = $this->artistRecord->getArtist($id);
        return $artist;
    }

    public function getAlbum($id)
    {
        $artistAlbum = $this->artistRecord->getAlbumByArtist($id);
        return $artistAlbum;
    }

    public function getSong($id)
    {
        $artistSong = $this->artistRecord->getSongByArtist($id);
        return $artistSong;
    }
}
