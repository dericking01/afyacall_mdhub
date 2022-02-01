<?php

namespace App\Http\Middleware;

use Closure;

class CheckHeader
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
        if ($request->header('accept') !== 'application/json') {
            return response()->json(['status' => 406, 'message' => 'Please set Accept header for application/json'], 406);
        }

        return $next($request);
    }
}
