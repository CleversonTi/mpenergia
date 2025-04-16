<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ProtegerAdmin
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
        if(!session()->has('usuario')){
            return redirect('app/login')->with('fail','Faça login para continuar');
        }



        return $next($request);
    }
}
