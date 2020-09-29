<?php

namespace App\Contracts\Dao\Auth;

interface AuthDaoInterface
{
    /**
     * @param string email
     * @return user
     */
    public function getUserByEmail($email);
    /**
     * update password
     * @param User $user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword( $user, $request);
}
