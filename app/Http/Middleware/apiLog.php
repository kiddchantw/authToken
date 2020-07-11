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
        $logResquest = ['uri: '=> $uri, 'method: '=>$method, 'details:'=>$body]; 
        Log::notice("request ", $logResquest);
        
        $response = $next($request);
        $body = $response->content();        
        $logResponse = ['uri: '=>$uri,'details:'=>$body]; 
        Log::notice("response ", $logResponse);
        return $response;
    }
}
