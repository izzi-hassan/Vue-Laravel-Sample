<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Profile extends Model
{
    protected $guarded = [];

    protected $hidden = [];

    protected $casts = [
        'children' => 'array',
        'interests' => 'array',
        'websites' => 'array',
        'reports' => 'array',
        'other_info' => 'array',
        'favorite_quote' => 'array'
    ];

    protected $appends = ['is_followed', 'avatar', 'joined_since'];

    // relationships
    public function posts() {
        return $this->hasMany('App\Models\ContentPost');
    }

    public function city() {
        return $this->belongsTo('App\Models\City');
    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function badges() {
        return $this->belongsToMany('App\Models\Badge', 'profile_badge')->withTimestamps();
    }

    public function favorites() {
        return $this->belongsToMany('App\Models\ContentPost', 'profile_content_post_favorites')->withTimestamps();
    }

    public function shares() {
        return $this->belongsToMany('App\Models\ContentPost', 'profile_content_post_shares')->withTimestamps();
    }

    public function bookmarks() {
        return $this->belongsToMany('App\Models\ContentPost', 'profile_content_post_bookmarks')->withTimestamps();
    }

    public function follows() {
        return $this->belongsToMany('App\Models\Profile', 'profile_profile_follows','follower_id', 'followee_id')->withTimestamps();
    }

    public function followers() {
        return $this->belongsToMany('App\Models\Profile', 'profile_profile_follows','followee_id', 'follower_id')->withTimestamps();
    }

    public function channels() {
        return $this->belongsToMany('App\Models\Channel')->withTimestamps();
    }

    // functions
    public function isFollowedBy(Profile $profile) {
        return $this->followers->contains($profile);
    }

    public function isFollowing(Profile $profile) {
        return $this->follows->contains($profile);
    }

    public function getIsFollowedAttribute() {
        return $this->isFollowedBy(Auth::user()->profile);
    }

    public function addFollower(Profile $profile) {
        $this->followers()->attach($profile->id);
    }

    public function removeFollower(Profile $profile) {
        $this->followers()->detach($profile->id);
    }

    public function follow(Profile $profile) {
        $profile->followers()->attach($this);
    }

    public function unFollow(Profile $profile) {
        $profile->followers()->detach($this);
    }

    public function subscribesTo(Channel $channel) {
        return $this->channels->contains($channel);
    }

    public function publish() {
        $this->is_published = true;
    }

    public function unPublish() {
        $this->is_published = false;
    }

    public function getAvatarAttribute() {
        return $this->user->{$this->user->last_auth . '_auth'}['avatar'];
    }

    public function getJoinedSinceAttribute() {
        return $this->user->created_at->format('M, Y');
    }
}
