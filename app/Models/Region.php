<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'country_id'];
    public $timestamps  = false;

    public function getCountry()
    {
        return $this->belongsTo('App\Models\Country','country_id','id');
    }
}
