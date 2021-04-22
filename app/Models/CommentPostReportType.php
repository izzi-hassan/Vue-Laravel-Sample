<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentPostReportType extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    // relationships
    public function reports() {
        return $this->belongsToMany('App\Models\CommentPostReport');
    }
}
