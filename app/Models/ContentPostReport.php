<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentPostReport extends Model
{
    protected $guarded = [];

    protected $casts = ['notes' => 'array', 'actions' => 'array'];

    // relationships
    public function status() {
        return $this->hasOne('App\Models\ReportStatus');
    }

    public function type() {
        return $this->hasOne('App\Models\ReportType');
    }

    public function reporter(){
        return $this->belongsTo('App\Models\Profile');
    }

    public function contentPost() {
        return $this->belongsTo('App\Models\ContentPost');
    }

    // functions
    public function updateStatus($statusId) {
        $this->status_id = $statusId;
    }

    public function addNote($note) {
        $this->notes[] = $note;
    }

    public function addAction($action) {
        $this->actions[] = $action;
    }
}