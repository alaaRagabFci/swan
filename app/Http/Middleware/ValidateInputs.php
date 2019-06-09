<?php

namespace App\Http\Middleware;
use Closure;

class ValidateInputs
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $data)
    {
        var_dump($data); die;
    }
}
