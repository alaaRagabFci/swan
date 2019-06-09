<?php
namespace App\Http\Controllers\Util;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AbstractController extends Controller
{
    public function getParameters($parameters, $type = null)
    {
        $data = $type ? json_decode($parameters,true) :  json_decode($parameters);
        return $data;
    }

    public function missingField($data , $keys)
    {
        foreach ($keys as $key) {
            if(!isset($data[$key]) || empty($data[$key]))
                return false;
        }
        return true;
    }

}