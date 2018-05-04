<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'latitude', 'longitude','description','adresse','ville','code_postal','horaire_debut','horaire_fin','user_id'
    ];

    protected $hidden = [
        'votes'
    ];

    protected $appends = [
        'positiveVotes','negativeVotes'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function votes() {
        return $this->hasMany('App\Vote');
    }

    public function getPositiveVotesAttribute() {
        return $this->votes->where('value', 1)->count();
    }

    public function getNegativeVotesAttribute() {
        return $this->votes->where('value', 0)->count();
    }
    
}
