<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    // relationships
    public function cities() {
        return $this->hasMany('App\Models\City');
    }
}
