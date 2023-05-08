<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccess
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
        if(auth()->user()->role_id == 0|| auth()->user()->role_id == 1 || auth()->user()->role_id == 2){
            return $next($request);
        }else if(auth()->user()->role_id == 3){
            return redirect()->route('student.details');
        }
           
        return response()->json(['You do not have permission to access for this page.']);
        
    }
}
