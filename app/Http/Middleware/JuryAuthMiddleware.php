<?php

namespace App\Http\Middleware;

use Closure;

class JuryAuthMiddleware
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
        if($request->user()){
            if(! $request->user()->hasRole('Jury') && ! $request->user()->hasRole('Super Admin') && ! $request->user()->hasRole('Administrator')){
                flash()->error(trans('front.you_must_log_in_as_jury'));
                return redirect(action('Jury\AuthController@auth'));
            }
        }else{
            return redirect(action('Jury\AuthController@auth'));
        }
        return $next($request);
    }
}
