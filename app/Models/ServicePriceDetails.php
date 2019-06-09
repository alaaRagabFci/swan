<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePriceDetails extends Model
{
    protected $table = "servie_prices_details";
    protected $fillable = ['air_type_id', 'service_id', 'range_from', 'range_to', 'price'];
    public $timestamps  = false;

    public function getAirType()
    {
        return $this->belongsTo('App\Models\AirType','air_type_id','id');
    }

    public function getService()
    {
        return $this->belongsTo('App\Models\Service','service_id','id');
    }
}
