<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

use Symfony\Component\HttpFoundation\Response;

class checkToken
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
        // var_dump($request->all());
        // return $request->user();
        // $user = User::where([['id', '=', $request->id], ['remember_token', '=', $request->remember_token]])->first();
        $user = User::where('remember_token', '=', $request->remember_token)->first();
        
        if ($user) {
            // var_dump($user->name );
            // return response()->json(['message' => $user], 200);
            // $request = $user ;
            // return $next($request);
             return $next($user);

        }else{
            return response()->json(['message' => 'User Token not found 2 !'], 404);
        }
        

    }
}
