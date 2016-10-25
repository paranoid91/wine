<?php

namespace App\Http\Middleware;

use Closure;

class Languages
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
        if(!empty(explode_url($request->route()->uri()))){
            if(strlen(explode_url($request->route()->uri())) == 2){
                \App::setLocale(explode_url($request->route()->uri()));
                $request->session()->set('locale',explode_url($request->route()->uri()));
            }

        }
        return $next($request);
    }
}
