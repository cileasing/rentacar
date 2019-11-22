<?php

namespace App\Http\Middleware;

use Closure;

class Driver
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
        $message = 'You are not a driver';
        if(auth()->user()->user_type == 2) {
            return $next($request);
        }
        return response()->json([
            'message' => $message
        ]);
    }
}
