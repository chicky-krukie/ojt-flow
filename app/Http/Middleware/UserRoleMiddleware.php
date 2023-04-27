<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        if(Auth::check()) {
            if(Auth::user()->role == $role){
                return $next($request);
            }
            return response()->json(['You do not have permission to access for this page.']);
            // return response()->json(['message' => 'You do not have permission to access this page.'], 403);
        }
    
        // Redirect the user to the login page
        return redirect()->route('login');
        
    }
}
