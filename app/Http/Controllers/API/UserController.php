<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    protected $userInterface;
    protected $authInterface;

    /**
     * @param UserServiceInterface $userInterface
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface, AuthServiceInterface $authInterface)
    {
        $this->userInterface = $userInterface;
        $this->authInterface = $authInterface;
    }
    /**
     * get userlist
     */
    public function index()
    {
        $users = $this->userInterface->getUserList();
        return response()->json($users);
    }
    /**
     * search user by search keyword
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $createdFrom = $request->input('createdfrom');
        $createdTo = $request->input('createdto');
        $userList = $this->userInterface->getSearchUser($name, $email, $createdFrom, $createdTo);
        return response()->json($userList);
    }
    /**
     * confirm create
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $existenceUser = $this->authInterface->getUserByEmail($request->email);
        if ($existenceUser) {
            return response()->json(['message' => 'User is already exist']);
        }
        $exploded = explode(',', $request->profile);
        $decoded = base64_decode($exploded[1]);

        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }
        $filename = time() . '.' . $extension;
        $path = public_path() . '/' . $filename;
        file_put_contents($path, $decoded);
        $request->profile = $filename;
        $this->userInterface->saveUser($request);
    }
    /**
     * updated user
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request)
    {
        $user = User::find($request->id);
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
        if ($request->profile) {
            $oldProfile = $user->profile;
            $oldImage = file_exists(public_path() . '/' . $oldProfile);
            if ($oldImage) {
                Storage::delete('public/' .$oldProfile);
            }
            $exploded = explode(',', $request->profile);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }
            $filename = time() . '.' . $extension;
            $path = public_path() . '/' . $filename;
            file_put_contents($path, $decoded);
            $request->profile = $filename;
            $user->profile = $request->profile;
            $user->update_user_id = Auth::user()->id;
            $user->save();
        }
    }
    /**
     * delete user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->userInterface->deleteUser($id);
    }
}
