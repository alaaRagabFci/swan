<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRate extends Model
{
    protected $table = "user_rates";
    protected $fillable = ['application_id', 'company_id', 'comment', 'rate'];
    public $timestamps  = false;

    public function getApplication()
    {
        return $this->belongsTo('App\Models\Application','application_id','id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\User','company_id','id');
    }
}
