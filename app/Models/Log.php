<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['user_id', 'entity', 'entity_id', 'description'];
    public $timestamps  = false;

    public function getUser()
    {
        return $this->belongsTo('App\User','user_id','id');
    }
}
