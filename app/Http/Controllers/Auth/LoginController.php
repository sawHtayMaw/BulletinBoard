<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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
    protected $redirectTo = RouteServiceProvider::POSTS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(Request $request)
    {
        // $request->validate([
        //     'email' => 'required|email|exists:users,email',
        //     'password' => 'required'
        // ]);

        if( Auth::attempt(['email'=>$request->email, 'password'=>$request->password]) ) {
            $user = Auth::user();
            //$user = User::where('email', $request->email)->first();

            $token = $user->createToken($user->email.'-'.now());
            $token->expires_at= Carbon::now()->addWeek(1);
            return response()->json([
                'token' => $token->accessToken,
                'user' => $user,
                'token_type'=>'Bearer',
                'expires_at'=>Carbon::parse($token->expires_at)
                        ->toDateTimeString()
            ]);
        }

    }
    public function logout()
    {
        Auth::logout();
        return response()
        ->json([
            'logout' => true
        ]);

    }

}
