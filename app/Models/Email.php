<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'title', 'message'];
    public $timestamps  = false;

}
