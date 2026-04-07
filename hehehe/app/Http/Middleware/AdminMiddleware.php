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
        if(!Auth::check()){
            return redirect('/login')->with('error', 'vui long dang nhap de tiep tuc');
        }
        if(Auth::user()->role != 1){
            return redirect('/')->with('error', 'ban deo co quyen truy cap');
        }
        return $next($request);
    }
}
