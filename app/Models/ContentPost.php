<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContentPost extends Model
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
        'meta' => 'array'
    ];

    protected $appends = [
        'is_shared', 'is_bookmarked', 'is_favorited', 'time_passed', 'is_edited', 'num_shares', 'num_bookmarks', 'num_favorites', 'score', 'num_comments'
    ];

    // relationships
    public function channel() {
        return $this->belongsTo('App\Models\Channel');
    }

    public function type() {
        return $this->belongsTo('App\Models\ContentType', 'content_type_id');
    }

    public function author() {
        return $this->belongsTo('App\Models\Profile', 'profile_id');
    }

    public function commentPosts() {
        return $this->hasMany('App\Models\CommentPost');
    }

    public function favoritedBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_content_post_favorites');
    }

    public function sharedBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_content_post_shares');
    }

    public function bookmarkedBy() {
        return $this->belongsToMany('App\Models\Profile', 'profile_content_post_bookmarks');
    }

    // functions
    public function getTimePassedAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getIsEditedAttribute() {
        return $this->updated_at->gt($this->created_at);
    }

    // shares
    public function isSharedBy(Profile $profile) {
        return $this->sharedBy->contains($profile);
    }

    public function getNumSharesAttribute() {
        return $this->sharedBy()->count();
    }

    public function addShare(Profile $profile) {
        $this->sharedBy()->attach($profile);
    }

    public function share() {
        $this->addShare(Auth::user()->profile);
    }

    public function removeShare(Profile $profile) {
        $this->sharedBy()->detach($profile);
    }

    public function unShare() {
        $this->removeShare(Auth::user()->profile);
    }

    public function getIsSharedAttribute() {
        return $this->isSharedBy(Auth::user()->profile);
    }

    // favorites
    public function isFavoritedBy(Profile $profile) {
        return $this->favoritedBy->contains($profile);
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

    public function getIsFavoritedAttribute() {
        return $this->isFavoritedBy(Auth::user()->profile);
    }

    // bookmark
    public function addBookmark(Profile $profile) {
        $this->bookmarkedBy()->attach($profile);
    }

    public function getNumBookmarksAttribute() {
        return $this->bookmarkedBy()->count();
    }

    public function bookmark() {
        $this->addBookmark(Auth::user()->profile);
    }

    public function removeBookmark(Profile $profile) {
        $this->bookmarkedBy()->detach($profile);
    }

    public function unBookmark() {
        $this->removeBookmark(Auth::user()->profile);
    }

    public function isBookmarkedBy(Profile $profile) {
        return $this->bookmarkedBy->contains($profile);
    }

    public function getIsBookmarkedAttribute() {
        return $this->isBookmarkedBy(Auth::user()->profile);
    }

    public function getScoreAttribute() {
        return $this->getNumBookmarksAttribute() + $this->getNumFavoritesAttribute() + $this->getNumSharesAttribute() + $this->commentPosts()->count();
    }

    public function getNumCommentsAttribute() {
        return $this->commentPosts()->count();
    }
}
