<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

     // Check whether the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }
    if(Auth::user()->role == 'user' ){
            return $next($request);
        }else{
            return back();
            //abort(403);
        }
      
    }
}
