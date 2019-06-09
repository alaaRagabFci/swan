<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['twitter', 'instgram', 'location','phone', 'email', 'informations', 'waiting_order_time', 'notify_time', 'not-assign_late_time'];
    public $timestamps  = false;
}
