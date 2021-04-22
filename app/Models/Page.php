<?php

namespace App\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Intervention\Image\ImageManagerStatic;

class Page extends Model
{
    use CrudTrait;
    use Sluggable;
    use SluggableScopeHelpers;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'pages';
    protected $primaryKey = 'id';
    public $timestamps = true;
    // protected $guarded = ['id'];
    protected $fillable = ['template', 'name', 'heading', 'subheading', 'parent_id', 'meta', 'title', 'slug', 'content', 'extras', 'cover_image'];
    // protected $hidden = [];
    // protected $dates = [];
    protected $fakeColumns = ['extras', 'meta'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_title',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function getTemplateName()
    {
        return trim(preg_replace('/(id|at|\[\])$/i', '', ucfirst(str_replace('_', ' ', $this->template))));
    }

    public function getPageLink()
    {
        return url($this->slug);
    }

    public function getOpenButton()
    {
        return '<a class="btn btn-default btn-xs" href="'.$this->getPageLink().'" target="_blank"><i class="fa fa-eye"></i> Open</a>';
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function parent() {
        return $this->belongsTo('App\Models\Page');
    }

    public function children() {
        return $this->hasMany('App\Models\Page');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */

    public function setCoverImageAttribute($value)
    {
        $attribute_name = "cover_image";
        $disk = "uploads";
        $destination_path = "images/pages/cover-images/";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->image);

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = ImageManagerStatic::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $disk . '/' . $destination_path.$filename;
        }
    }
}
