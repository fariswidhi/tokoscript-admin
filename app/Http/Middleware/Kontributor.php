<?php

namespace App\Http\Middleware;

use Closure;

class Kontributor
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
      

        if (session('levelid')== "2"||session('levelid')== "1") {
            return $next($request);
            # code...
        }
        return abort(404);

    }
}
