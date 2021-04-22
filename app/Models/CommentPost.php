<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommentPost extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $guarded = [];

    // Type cast json fields
    protected $casts = [
        'notes' => 'array',
    ];

    protected $appends = ['time_passed', 'is_edited', 'is_favorited', 'num_favorites', 'is_followed', 'num_follows', 'is_helpful', 'num_helpfuls'];

    // relationships
    public function contentPost() {
        return $this->belongsTo('App\Models\ContentPost');
    }

    public function parent() {
        return $this->belongsTo('App\Models\CommentPost');
    }

    public function children() {
        return $this->hasMany('App\Models\CommentPost');
    }

    public function reports() {
        return $this->hasMany('App\Models\CommentPostReport');
    }

    public function author() {
        return $this->belongsTo('App\Models\Profile');
    }

    public function favoritedBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_comment_post_favorites')->withTimestamps();
    }

    public function helpfulledBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_comment_post_helpfuls')->withTimestamps();
    }

    public function followedBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_comment_post_follows')->withTimestamps();
    }

    // functions
    public function getTimePassedAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getIsEditedAttribute() {
        return $this->updated_at->gt($this->created_at);
    }

    public function addReport(CommentPostReport $report) {
        $this->reports()->attach($report);
    }

    // favorites
    public function isFavoritedBy(Profile $profile) {
        return $this->favoritedBy->contains($profile);
    }

    public function getIsFavoritedAttribute() {
        return $this->isFavoritedBy(Auth::user()->profile);
    }

    public function getNumFavoritesAttribute() {
        return $this->favoritedBy()->count();
    }

    public function addFavorite(Profile $profile) {
        $this->favoritedBy()->attach($profile);
    }

    public function favorite() {
        $this->addFavorite(Auth::user()->profile);
    }

    public function removeFavorite(Profile $profile) {
        $this->favoritedBy()->detach($profile);
    }

    public function unFavorite() {
        $this->removeFavorite(Auth::user()->profile);
    }

    //follows
    public function isFollowedBy(Profile $profile) {
        return $this->followedBy->contains($profile);
    }

    public function getIsFollowedAttribute() {
        return $this->isFollowedBy(Auth::user()->profile);
    }

    public function numFollows() {
        return $this->followedBy()->count();
    }

    public function addFollow(Profile $profile) {
        $this->followedBy()->attach($profile);
    }

    public function follow() {
        $this->addFollow(Auth::user()->profile);
    }

    public function removeFollow(Profile $profile) {
        $this->followedBy()->detach($profile);
    }

    public function unFollow() {
        $this->removeFollow(Auth::user()->profile);
    }

    // helpfuls
    public function isHelpfulledBy(Profile $profile) {
        return $this->helpfulledBy->contains($profile);
    }

    public function getIsHelpfulAttribute() {
        return $this->isHelpfulledBy(Auth::user()->profile);
    }

    public function numHelpfuls() {
        return $this->helpfulledBy()->count();
    }

    public function addHelpful(Profile $profile) {
        $this->helpfulledBy()->attach($profile);
    }

    public function helpful() {
        $this->addHelpful(Auth::user()->profile);
    }

    public function removeHelpful(Profile $profile) {
        $this->helpfulledBy()->detach($profile);
    }

    public function unHelpful() {
        $this->removeHelpful(Auth::user()->profile);
    }
}
