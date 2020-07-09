<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\User;
use Illuminate\Auth\EloquentUserProvider;
//use Auth;
use Illuminate\Support\Facades\Auth;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        Auth::viaRequest('token', function ($request) {
            //寫法2 因為orm 找不到就會null
            $user = User::where('remember_token', "=", $request->remember_token)->first();
            if ($user){
                $nowTimeStr = strtotime(date('Y/m/d H:i:s', time()));
                $tokenTimeStr = strtotime($user->token_expire_time);
                if ($tokenTimeStr > $nowTimeStr) {
                    return $user;
                } else {
                    return null;
                }
            }
           
        });
    }
}
