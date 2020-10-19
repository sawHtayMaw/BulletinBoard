<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //$user = User::where('email', $request->email)->first();
            $token = $user->createToken('Auth Token')->accessToken;
            $token->expires_at = Carbon::now()->addWeek(1);
            return response()->json([
                'token' => $token->accessToken,
                'user' => $user,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse($token->expires_at)
                    ->toDateTimeString(),
            ]);
        }

    }
    public function logout()
    {
        Auth::logout();
        return response()
            ->json([
                'logout' => true,
            ]);

    }

}
