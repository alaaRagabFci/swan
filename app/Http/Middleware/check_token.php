<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Resturant;
class check_token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$token)
    {
      $user = Resturant::where('token',$token)->first();
      if($user){
        return $next($request);
      }
      else{
        return response('{"status":-1}', 401);
      }
    }
}
