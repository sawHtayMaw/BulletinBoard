<?php
namespace App\Dao\Auth;

use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * SystemName : Bulletinboard
 * Description : DAO Implementation for Auth
 */
class AuthDao implements AuthDaoInterface
{
    /**
     * Get User By Email
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
    /**
     * update password
     * @param User $user
     * @param \Illuminate\Http\$request
     * @param  \Illuminate\Validation\Validator  $validator
     * @return \Illuminate\Http\Response
     */
    public function changePassword( $user, $request)
    {

        $user->password = Hash::make($request->password);
        $user->update();
    }
}
