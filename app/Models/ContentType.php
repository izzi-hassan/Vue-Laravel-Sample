<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    //relationships
    public function posts() {
        return $this->hasMany('App\Models\ContentPost');
    }
}
