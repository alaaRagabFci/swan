<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AirType extends Model
{
    protected $table = "air_types";
    protected $fillable = ['type'];
    public $timestamps  = false;

}
