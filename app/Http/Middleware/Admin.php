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
        if($u_id == 2 or $u_id==null){
            dd($u_id);
            return redirect('/');
        }else if($u_id == 3){
            return redirect('/admin/support/tickets');
        }
        
        return $next($request);
    }
}
