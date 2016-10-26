<?php

namespace App\Http\Middleware;

use Closure;

class ForUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($user_session = $request->session()->get('username') !== null){
            return redirect('/home');
        }
        return $next($request);
    }
}
