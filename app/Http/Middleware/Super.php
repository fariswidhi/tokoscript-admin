<?php

namespace App\Http\Middleware;

use Closure;

class Super
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
        if (session('levelid')=="1") {
            # code...
            return $next($request);

        }
        return abort(404);


    }
}
