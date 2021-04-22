<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    protected $guarded = [];

    // relationships
    public function category() {
        return $this->belongsTo('App\Models\BadgeCategory');
    }

    public function profiles() {
        return $this->belongsToMany('App\Models\Profile', 'profile_badge')->withTimestamps();
    }
}
