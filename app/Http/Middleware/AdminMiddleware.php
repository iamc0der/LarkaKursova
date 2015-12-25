<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  if(Auth::check()) {
        if (!is_null(Auth::user()->worker_id)) {
            abort(404);
        }
    }else return Redirect::route('user-login');
        return $next($request);
    }
}
