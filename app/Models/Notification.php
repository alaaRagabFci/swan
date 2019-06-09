<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['application_id', 'type', 'text', 'user_type', 'user_id'];
//    public $timestamps  = false;

}
