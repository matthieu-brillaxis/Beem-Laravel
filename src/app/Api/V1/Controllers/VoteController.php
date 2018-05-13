<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Vote;
use Auth;

class VoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', []);
    }

    // Get all votes

    public function getVotes()
    {
        $votes = Vote::all();

        return response()
            ->json(
                $votes
            );
    }

    // Get all votes from one user
    
    public function getUserVotes($user_id)
    {
        // $vote = Vote::where('user_id','=', intval($user_id))->get();

        $vote = Vote::with(['place' => function($query){
            $query->select(['id','name','description','ville','adresse','code_postal','horaire_debut','horaire_fin']);
        }])->where('user_id','=',intval($user_id))->orderBy('value', 'desc')->get()->makeHidden(['updated_at','created_at']);

        return response()
            ->json(
                $vote
            );
    }

    // Get all votes from one place

    public function getPlaceVotes($place_id)
    {
        $vote = Vote::where('place_id','=', intval($place_id))->get();
        
        return response()
            ->json(
                $vote
            );
    }

    // Post one votes

    public function postVote(Request $request)
    {
        $value = $request->input('value');
        $place_id = $request->input('place_id');
        $user_id = Auth::guard()->user()->id;

        $vote = new Vote([
            'value' => intval($value),
            'user_id' => intval($user_id),
            'place_id' => intval($place_id),
        ]);

        $vote->save();

        return response()
            ->json(
                $vote
            );
    }

    // Update current vote

    public function updateVote($place_id, $value)
    {
        $id = Auth::guard()->user()->id;
        $vote = Vote::updateOrCreate(['user_id'=>$id, 'place_id'=>$place_id], ['value' => $value]);
        // $vote = Vote::where([['user_id','=',intval($id)],['place_id','=',intval($place_id)]])->get();

        return response()
            ->json(
                $vote
            );
    }
    
}
