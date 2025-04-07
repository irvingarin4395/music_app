<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;


class VoteController extends Controller
{
    protected $voteRecord;

    public function __construct(Vote $vote)
    {
        $this->voteRecord = $vote;
    }
    public function vote(Request $request)
    {
        $vote = $this->voteRecord->getVote($request->user()->id, $request);
        $data = [
            'message' => 'thank for voting.',
            'album_id' => $request->album_id,
            'like' => 0,
            'dislike' => 0
        ];

        if ($vote) {
            if ($vote->vote_type == 1 && $request->vote_type == -1) {
                $data['like'] = -1;
                $data['dislike'] = 1;
            } elseif ($vote->vote_type == -1 && $request->vote_type == 1) {
                $data['like'] = 1;
                $data['dislike'] = -1;
            }

            $vote->update([
                'vote_type' => $request->vote_type
            ]);
        } else {
            $request->user()->vote()->create([
                'album_id' => $request->album_id,
                'vote_type' => $request->vote_type
            ]);
            if ($request->vote_type == 1) {
                $data['like'] = 1;
            } else {
                $data['dislike'] = 1;
            }
        }

        return $data;
    }
}
