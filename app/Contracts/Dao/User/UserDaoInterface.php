<?php

namespace App\Contracts\Dao\User;

use App\Models\User;
use Illuminate\Http\Request;

interface UserDaoInterface
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList();
    /**
     * userlist by search keyword
     * @param string $name
     * @param string $email
     * @param date $createdFrom
     * @param date $createdTo
     * @return userList
     */
    public function getSearchUser($name, $email, $createdFrom, $createdTo);
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
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function saveUser($request);
    /**
     * update user
     * @param int $id
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id);
    /**
     * delete user
     * @param int $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($user);
}
