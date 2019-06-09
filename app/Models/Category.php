<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    protected $fillable = ['name', 'sort', 'is_active', 'x', 'commission_more', 'commission_less'];
    public $timestamps  = false;

}
