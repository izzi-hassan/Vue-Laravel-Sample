<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrivacySettings extends Model
{
    protected $guarded = [];
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
