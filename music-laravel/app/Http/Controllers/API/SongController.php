<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;

class SongController extends Controller
{
    protected $songRecord;

    public function __construct(Song $song)
    {
        $this->songRecord = $song;
    }

    public function index()
    {
        $allSongs = $this->songRecord->getAllSong();
        return $allSongs;
    }

    public function info($id)
    {
        $song = $this->songRecord->getSongById($id);
        return $song;
    }
}
