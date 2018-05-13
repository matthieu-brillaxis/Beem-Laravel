<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\Traits\HasCompositePrimaryKey;


class Vote extends Model
{
    // use HasCompositePrimaryKey;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value', 'user_id', 'place_id'
    ];

    // protected $primaryKey = ['place_id','user_id'];

    // public $incrementing = false;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function place() {
        return $this->belongsTo('App\Place');
    }
}
