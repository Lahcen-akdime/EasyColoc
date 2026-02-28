<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class clientMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->is_banned==true){
        Auth::logout();
        return to_route('login')->with('error','You are banned by the admin');
        }
        elseif(Auth::user()->role=='client'){
            return $next($request);
        }
        else{
            return back();
        }
    }
}
