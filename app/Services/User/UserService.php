<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Models\User;
use App\Util\StringUtil;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    private $userDao;

    /**
     * Class Constructor
     * @param OperatorUserDaoInterface $userDao
     * @return
     */
    public function __construct(UserDaoInterface $userDao)
    {
        $this->userDao = $userDao;
    }
    /**
     * get user list
     * @return userList
     */
    public function getUserList()
    {
        return $this->userDao->getUserList();
    }
    /**
     * Get User available or not Message
     *
     * @param List<User> userList
     * @return message
     */
    public function getAvailableMessage($userList)
    {
        $message = "";
        if (count($userList) <= 0)
            $message = 'No user available!';
        return $message;
    }
    /**
     * user list by search keyword
     * @param string $name
     * @param string $email
     * @param date $createdFrom
     * @param date $createdTo
     */
    public function getSearchUser($name, $email, $createdFrom, $createdTo)
    {
        return $this->userDao->getSearchUser($name, $email, $createdFrom, $createdTo);
    }
    /**
     * get user by id
     * @param int $id
     * @return user
     */
    public function getUserById($id)
    {
        return $this->userDao->getUserById($id);
    }
    /**
     * get user by email
     * @param string $email
     * @return user
     */
    public function getUserByEmail($email)
    {
        return $this->userDao->getUserByEmail($email);
    }
    /**
     * save user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveUser($request)
    {
        return $this->userDao->saveUser($request);
    }
    /**
     * Check Method Email of User Duplicated or Not
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function duplicateUser(Request $request)
    {
        if (StringUtil::isNotEmpty($this->userDao->getUserByEmail($request->input('email')))) {
            return true;
        } else {
            false;
        }

    }
    /**
     * update user
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        return $this->userDao->updateUser($request);
    }
    /**
     * delete user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        return $this->userDao->deleteUser($id);
    }

}
