<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserPermission
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

        if (auth('api')->user()->id != $request->route()->parameter('id')) {
            return response()->json(['data' => 'unidentified user']);
        }
        return $next($request);
    }

}
