<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    // relationships
    public function country() {
        return $this->belongsTo('App\Models\Country');
    }

    public function profiles() {
    	return $this->hasMany('App\Models\Profile');
    }
}
