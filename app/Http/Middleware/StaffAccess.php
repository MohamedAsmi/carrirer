<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->role_id == 2||auth()->user()->role_id == 3) {
            return response(['message'=>'You do not have permission to access for this page.'] ,422);
        }else{
            // dd($next($request));
            return $next($request);
        }
        // return $next($request);
        return response()->json(['You do not have permission to access for this page.']);
    }
}
