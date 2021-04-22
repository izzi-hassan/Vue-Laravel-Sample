<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, CrudTrait, HasRoles;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $guarded = [];

    // Type cast json fields
    protected $casts = [
        'facebook_auth' => 'array',
        'twitter_auth' => 'array',
        'linkedin_auth' => 'array'
    ];

    // properties

    // relationships
    public function profile() {
        return $this->hasOne('App\Models\Profile');
    }

    public function profileSettings() {
        return $this->hasOne('App\Models\ProfileSettings');
    }

    public function accountSettings() {
        return $this->hasOne('App\Models\AccountSettings');
    }

    public function privacySettings() {
        return $this->hasOne('App\Models\PrivacySettings');
    }
}
