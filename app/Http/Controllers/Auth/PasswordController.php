<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Contracts\Services\User\UserServiceInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    /**
     * UserInterface Declaration to access Business Logic for System
     */
    private $userInterface;

    /**
     * AuthInterface Declaration to access Business Logic for System
     */
    private $authInterface;
    /**
     * create a new controller instance
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface, AuthServiceInterface $authInterface )
    {
        $this->authInterface=$authInterface;
        $this->userInterface=$userInterface;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userInterface->getUserById($id);
        return view('auth.passwords.password_reset')->with('user', $user);
    }
    /**
     * update password
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user= $this->userInterface->getUserById($request->id);
        $user->password = Hash::make($request->newPassword);
        $user->update();
    }
}
