<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportStatus extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    const OPEN = 0;
    const UNDER_INVESTIGATION = 1;
    const CLOSED = 2;

    // relationships
    public function commentPostReports() {
        return $this->hasMany('App\Models\CommentPostReport');
    }

    public function contentPostReports() {
        return $this->hasMany('App\Models\ContentPostReport');
    }

    public function profileReports() {
        return $this->hasMany('App\Models\ProfileReport');
    }
}
