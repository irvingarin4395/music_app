<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\Artist;
use Hamcrest\Core\IsEqual;

class AlbumController extends Controller
{
    protected $albumRecord;

    public function __construct(Album $album)
    {
        $this->albumRecord = $album;
    }

    public function index()
    {
        $allAlbum = $this->albumRecord->getAllAlbum();
        $position = 0;
        foreach ($allAlbum as $album) {
            $like = 0;
            $dislike = 0;
            foreach ($album->vote as $vote) {
                if ($vote->vote_type == 1) {
                    $like++;
                } else {
                    $dislike++;
                }
            }
            $allAlbum[$position]->like = $like;
            $allAlbum[$position]->dislike = $dislike;
            $position++;
        }
        return $allAlbum;
    }

    public function get($id)
    {
        $album = $this->albumRecord->getAlbum($id);
        return $album;
    }

    public function getSong($id)
    {
        $album = $this->albumRecord->getAlbumSong($id);
        return $album;
    }

    public function search(Request $request)
    {
        $albumVotes = $this->albumRecord->searchAlbum($request->search);
        $position = 0;
        foreach ($albumVotes as $votes) {
            $like = 0;
            $dislike = 0;
            foreach ($votes->vote as $uservote) {
                if ($uservote->vote_type == 1) {
                    $like++;
                } else {
                    $dislike++;
                }
            }
            $albumVotes[$position]->like = $like;
            $albumVotes[$position]->dislike = $dislike;
            $position++;
        }
        return $albumVotes;
    }

    public function delete($id)
    {
        $this->albumRecord->deleteAlbum($id);
        return ['message' => "Album is deleted"];
    }
}
