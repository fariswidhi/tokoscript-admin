<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
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
        // if (empty(session('userid'))) {
        
        //     return redirect(route('login'));

        // }
        if ($request->segment(1)!="login" AND $request->segment(1)!="register") {
        // echo $request->segment(1);
        	// echo "string";
        	// echo session('userid');//
            // exit();
         if (session('adminid') == null) {
            	return redirect('/login');
        }
        else
                return $next($request);
        }
        else{
        if (session('adminid') != null) {
            return redirect('/');
        }
        else{

        }
        }


        return $next($request);
    }
}
