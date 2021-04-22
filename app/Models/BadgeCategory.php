<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BadgeCategory extends Model
{
    protected $guarded = [];

    // relationships
    public function badges() {
        return $this->hasMany('App\Models\Badge');
    }
}
