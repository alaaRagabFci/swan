<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['name'];
    public $timestamps  = false;

    public function getRegions()
    {
        return $this->hasMany('App\Models\Region');
    }

}
