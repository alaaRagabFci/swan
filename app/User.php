<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'is_active', 'is_blocked', 'is_export', 'services', 'token', 'category_id', 'company_id', 'region_id', 'type', 'password'
    ];

    public function getCategory()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function getRegion()
    {
        return $this->belongsTo('App\Models\Region','region_id','id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\User','company_id','id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
