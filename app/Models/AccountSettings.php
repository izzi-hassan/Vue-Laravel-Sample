<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSettings extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('App\Models\User');
    }
}
