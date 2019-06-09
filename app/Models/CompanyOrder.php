<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyOrder extends Model
{
    protected $table = "company_orders";
    protected $fillable = ['application_id', 'company_id'];
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
