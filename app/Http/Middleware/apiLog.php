<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class apiLog
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
        $uri = $request->path();
        $method = $request->method();
        $body = $request->all();
        $log = ['uri: '=> $uri, 'method: '=>$method, 'details:'=>$body]; 
        
        Log::notice("request", $log);
        return $next($request);
    }
}
