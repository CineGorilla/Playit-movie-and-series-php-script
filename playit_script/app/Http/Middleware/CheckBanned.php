<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class CheckBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::user() && Auth::user()->blocked == 1){
            Auth::logout();
            $message = 'Your account has been suspended. Please contact administrator.';
            return redirect('/login')->withMessage($message);
        }
        return $next($request);
                    

    }
}
