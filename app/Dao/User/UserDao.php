<?php
namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserDao implements UserDaoInterface
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList()
    {
        $userList = User::where('delete_user_id', null)->paginate(5);
        return $userList;
    }
    /**
     * user list by search keyword
     * @param string $name
     * @param string $email
     * @param date $createdFrom
     * @param date $createdTo
     * @return userList
     */
    public function getSearchUser($name, $email, $createdFrom, $createdTo)
    {
        $user = User::query();
        if (!empty($name)) {
            $user->where('name', 'LIKE', '%' . $name . '%');
        }
        if (!empty($email)) {
            $user->where('email', 'LIKE', '%' . $email . '%');
        }
        if (!empty($createdFrom) && !empty($createdTo)) {
            $user->whereBetween('created_at', [$createdFrom, $createdTo])->first();
        }
        $userList = $user->get();
        return $userList;
    }
    /**
     * get user by id
     * @param int $id
     * @return user
     */
    public function getUserById($id)
    {
        return User::find($id);
    }
    /**
     * get user by email
     * @param string $email
     * @return user
     */
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }
    /**
     * save user
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function saveUser($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $profile = explode("/", $request->profile);
        $user->profile = $profile[1];
        $user->save();
    }
    /**
     * update User
     * @param int $id
     * @param \Illuminate\Http\$request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->type == "Admin") {
            $user->type = "0";
        } else {
            $request->type = "1";
        }
        $user->dob = $request->dob;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $profile = explode("/", $request->profile);
        $user->profile = $profile[1];
        $user->save();
    }
    /**
     * delete user
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($user)
    {
        $user = User::where('id', $user->id)->delete();
    }
}
