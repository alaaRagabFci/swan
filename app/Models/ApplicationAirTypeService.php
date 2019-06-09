<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationAirTypeService extends Model
{
    protected $table = "application_air_types_services";
    protected $fillable = ['application_id', 'air_type_id', 'service_id', 'number'];
    public $timestamps  = false;

    public function getApplication()
    {
        return $this->belongsTo('App\Models\Application','application_id','id');
    }

    public function getAirType()
    {
        return $this->belongsTo('App\Models\AirType','air_type_id','id');
    }

    public function getService()
    {
        return $this->belongsTo('App\Models\Service','service_id','id');
    }
}
