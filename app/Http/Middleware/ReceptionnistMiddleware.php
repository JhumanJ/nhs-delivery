<?php

namespace App\Http\Middleware;

use Closure;

class ReceptionnistMiddleware
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
        if ($request->user()->type != 2 && $request->user()->type != 3)
        {
            return redirect('/');
        }

        return $next($request);
    }
}
