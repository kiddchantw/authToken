<?php

namespace App\Http\Middleware;

use Closure;

use App\User;
use Illuminate\Support\Facades\Auth;


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
        //m1 ok
        $user = User::where('remember_token', '=', $request->remember_token)->first();
        if ($user) {
            $request->merge(['user' => $user]);
            //add this
            $request->setUserResolver(function () use ($user) {
                return $user;
            });
            // if you dump() you can now see the $request has it
            // dump($request->user());
            return $next($request);
        } else {
            return response()->json(['message' => 'User Token not found in checkToken!'], 404);
        }

                // var_dump($request->all());
        // $user = User::where([['id', '=', $request->id], ['remember_token', '=', $request->remember_token]])->first();
// var_dump($user->name );
            // return response()->json(['message' => $user], 200);
            // $request = $user ;
    }
}
