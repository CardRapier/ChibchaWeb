<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( auth()->user() == null ){
            return redirect('/'); 
        }
        $u_id = auth()->user()->user_type_id;
        if($u_id == 2){
            return redirect('/');
        }
        return $next($request);
    }
}
