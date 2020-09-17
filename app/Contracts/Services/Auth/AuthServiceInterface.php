<?php

namespace App\Contracts\Services\Auth;

interface AuthServiceInterface
{
    /**
     * Get User By Email
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email);
    /**
     * update password
     * @param User $user
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function changePassword($user, $request);
}
