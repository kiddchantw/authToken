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
        //m1 ok
        $user = User::where('name', '=', $request->name)->first();
        $user->remember_token =  Str::random(60);
        $user->save();
        // Auth::login($user);
        return $user->remember_token;

        
        // $user =  Auth::attempt(['name' => $request->name, 'password' => $password, 'status' => $status]));

        //$user = User::where([['name','=',$request->name],['password','=', Hash::make($request->password)]])->first();

    }


    public function show(Request $request)
    {
        // $user = User::find($userId);
        //

        //m2 ok : 目標 token去找  $request->user()
        var_dump("login controller");
        return $request->user();


        // m1 ok :直接orm 找
        // $user = User::where([['id', '=', $request->id], ['remember_token', '=', $request->remember_token]])->first();
        // if ($user) {
        //     return response()->json(['message' => $user], 200);
        // }
        // return response()->json(['message' => 'User not found!'], 404);
    }

    public function showV2(Request $request){
        var_dump ( Auth::user()->name );
        // return $request->user();
    }

    
}
