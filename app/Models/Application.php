<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['name', 'phone', 'hour_id', 'day', 'region', 'status', 'longitude', 'latitude', 'company_id', 'reason', 'confirmation_code', 'is_active'];
    public $timestamps  = false;

    public function getHour()
    {
        return $this->belongsTo('App\Models\Hour','hour_id','id');
    }

    public function getCompany()
    {
        return $this->belongsTo('App\User','company_id','id');
    }

    public function getInvoice()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function getServiceTypes()
    {
        return $this->belongsToMany('App\Models\Service','application_air_types_services','application_id','service_id');
    }

    public function getAirTypes()
    {
        return $this->belongsToMany('App\Models\AirType','application_air_types_services','application_id','air_type_id');
    }
}
