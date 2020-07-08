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
        // return response()->json([ 'message' => $request ], 200);
        // $user = User::where([['name','=',$request->name],['password','=', $request->password]])->first();
        $user = User::where('name', '=', $request->name)->first();
        $user->remember_token =  Str::random(60);
        $user->save();
        Auth::login($user);
        return $user->remember_token;
    }


    public function show(Request $request)
    {
        // $user = User::find($userId);
        //
        //目標只透過token去找  $request->user()
        // dd("111");
        var_dump("login controller");
        var_dump($request->all());
        return $request->user();



        // $user = User::where([['id', '=', $request->id], ['remember_token', '=', $request->remember_token]])->first();

        // if ($user) {
        //     return response()->json(['message' => $user], 200);
        // }
        // return response()->json(['message' => 'User not found!'], 404);
    }
}
