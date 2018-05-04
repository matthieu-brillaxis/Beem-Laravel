<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'user_id', 'place_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function place() {
        return $this->belongsTo('App\Place');
    }
}
