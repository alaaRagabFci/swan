<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = ['invoice_number', 'application_id', 'export', 'export_id', 'amount', 'status', 'commission'];
    public $timestamps  = false;

    public function getApplication()
    {
        return $this->belongsTo('App\Models\Application','application_id','id');
    }

    public function getExporter()
    {
        return $this->belongsTo('App\User','export_id','id');
    }

}
