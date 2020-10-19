<?php

namespace App\Contracts\Services\User;

use App\Models\User;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList();
    /**
     * user list by search keyword
     * @param string $name
     * @param string $eamil
     * @param date $createdFrom
     * @param date $createdTo
     */
    public function getSearchUser($name, $email, $createdFrom, $createdTo);
    /**
     * Get User available or not Message
     *
     * @param List<User> $userList
     * @return message
     */
    public function getAvailableMessage($userList);
    /**
     * get user by id
     * @param int $id
     * @return user
     */
    public function getUserById($id);
    /**
     * get user by email
     * @param string $email
     * @return user
     */
    public function getUserByEmail($email);
    /**
     * save user
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Http\Response
     */
    public function saveUser(Request $request);
    /**
     * Check Method Email of User Duplicated or Not
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function duplicateUser(Request $request);
    /**
     * update user
     * @param int $id
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request);
    /**
     * delete user
     * @param user $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id);
}
