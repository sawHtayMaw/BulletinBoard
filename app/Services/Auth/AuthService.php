<?php

namespace App\Services\Auth;

use App\Contracts\Dao\Auth\AuthDaoInterface;
use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Models\User;

class AuthService implements AuthServiceInterface
{
    private $authDao;

    /**
     * Class Constructor
     *
     * @param OperatorAuthDaoInterface $authDao
     * @return
     */
    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }
    /**
     * Get User
     *
     * @param string $email
     * @return User
     */
    public function getUserByEmail($email)
    {
        return $this->authDao->getUserByEmail($email);
    }
    /**
     * update password
     * @param User $user
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function changePassword( $user, $request)
    {
        return $this->authDao->changePassword( $user, $request);
    }
}
