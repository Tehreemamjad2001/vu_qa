<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthAdmin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->user_role == "admin"){
            return $next($request);
        }
        return redirect('login');
    }


}
