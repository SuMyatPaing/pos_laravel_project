<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
   
    public function handle(Request $request, Closure $next): Response
    {
         //1. before login->login,register ->call
         //2. after login->admin,superadmin ->can access||| login,register ->cannot call
        
        if(Auth::user()){ //after login
           
            if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
                if($request->route()->getName()== 'login' || $request->route()->getName()== 'register' ){
                    return back();
                }else{
                    return $next($request);
                }
            }else{
                return back();//simple login
            }
            }else{//before login
                     return $next($request);
        }
        
        
        //  if(Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin'){
        //     return $next($request);
        // }else{
        //     return back();
        //     //abort(403);
        // }
      
    }
}
