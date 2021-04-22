<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Channel extends Model
{
    protected $guarded = [];
    protected $hidden = [];

    // relationships
    public function subscribers() {
        return $this->belongsToMany('App\Models\Profile')->withTimestamps();
    }

    public function posts() {
        return $this->hasMany('App\Models\ContentPost');
    }

    // functions
    public function subscribeBy(Profile $profile) {
        $this->subscribers()->attach($profile);
    }

    public function subscribe() {
        $this->subscribeBy(Auth::user()->profile);
    }

    public function unSubscribeBy(Profile $profile) {
        $this->subscribers()->detach($profile);
    }

    public function unSubscribe() {
        $this->unSubscribeBy(Auth::user()->profile);
    }
}
