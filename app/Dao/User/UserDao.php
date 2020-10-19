<?php
namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserDao implements UserDaoInterface
{
    /**
     * Get User List
     *
     * @return userList
     */
    public function getUserList()
    {
        $userList = User::get();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function saveUser($request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'dob' => $request->dob,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile' => $request->profile,
        ]);
    }
    /**
     * update User
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request)
    {
        $user = User::find($request->id);
        return response()->json($user);
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
        $user->profile = $request->profile;
        $user->update_user_id = Auth::user()->id;
        $user->save();
    }
    /**
     * delete user
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete_user_id = Auth::user()->id;
        $user->save();
        $user->delete();
    }
}
