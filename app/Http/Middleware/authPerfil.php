<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authPerfil
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (! $request->user()->hasRole( explode(",", $roles) ) ) :
            return redirect()->route('perfil');
        endif;

        return $next($request);
    }
}
