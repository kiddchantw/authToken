<?php

namespace App\Http\Middleware;

use Closure;
use Log;

class apiLogResponse
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
        $uri =  $request->path();
        $response = $next($request);
        $body = $response->content();
        
        $log = ['uri: '=>$uri,'details:'=>$body]; 
        Log::notice("response", $log);
        return $response;

    }
}
