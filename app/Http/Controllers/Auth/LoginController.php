<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\User;
use Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login(Request $request)
    {
        
        do  {
            $loginToken = Str::random(60);
            $checkTokenExist = User::where('remember_token', '=', $loginToken)->first();  
        } 
        while( $checkTokenExist );

        
        //m1 ok
        $user = User::where('name', '=', $request->name)->first();
        $user->remember_token =  $loginToken;
        $user->token_expire_time = date('Y/m/d H:i:s', time()+1*60);
        $user->save();
        $response = array("token"=>$user->remember_token , "expire_time"=> $user->token_expire_time) ;
                
        return response()->json(['message' => $response], 200);

    }


    public function show(Request $request)
    {
        //m2 ok : 目標 token去找  $request->user()
        var_dump("login controller");
        return $request->user();

    }

    public function showV2(Request $request){
        // var_dump ( Auth::user()->name );
        return $request->user();
    }


    public function refreshToken(Request $request){
        $user = $request->user();
        $user->token_expire_time = date('Y/m/d H:i:s', time()+5*60);
        $user->save();

        $response = array("token"=>$user->remember_token , "expire_time"=> $user->token_expire_time) ;   
        return response()->json(['message' => $response], 200);
    }

    public function logout(Request $request){


        $user = $request->user();
        $user->remember_token = Null;
        $user->token_expire_time = Null;

        $user->save();
        return response()->json(['message' => "logout success!"], 200);
    }
    
}
