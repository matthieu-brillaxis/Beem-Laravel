<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Http\Request;
use App\Place;
use Auth;

class PlaceController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', []);
    }

    // Get all places

    public function getPlaces()
    {
        $places = Place::all()->makeHidden(['created_at','updated_at'])->toArray();

        return response()
            ->json(
                $places
            );
    }

    // Get one place with his {id}
    
    public function getPlace($id)
    {
        $place = Place::with(['user' => function($query){
            $query->select(['id','firstName']);
        }])->find($id)->makeHidden(['latitude','longitude','updated_at','created_at']);

        return response()
            ->json(
                $place
            );
    }

    // Post one place

    public function postPlace(Request $request)
    {
        $name = $request->input('name');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $adresse = $request->input('adresse');
        $ville = $request->input('ville');
        $code_postal = $request->input('code_postal');
        $horaire_debut = $request->input('horaire_debut');
        $horaire_fin = $request->input('horaire_fin');
        $user_id = Auth::guard()->user()->id;

        $place = new Place([
            'name' => $name,
            'description' => $description,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'adresse' => $adresse,
            'ville' => $ville,
            'code_postal' => $code_postal,
            'horaire_debut' => $horaire_debut,
            'horaire_fin' => $horaire_fin,
            'user_id' => $user_id
        ]);

        $place->save();

        return response()
            ->json(
                $place
            );
    }
    
}
