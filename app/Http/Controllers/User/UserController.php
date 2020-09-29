<?php

namespace App\Http\Controllers\User;

use App\Contracts\Services\Auth\AuthServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Util\StringUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $userInterface;
    private $authInterface;
    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct(UserServiceInterface $userInterface, AuthServiceInterface $authInterface)
    {
        $this->userInterface = $userInterface;
        $this->authInterface = $authInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = $this->userInterface->getUserList();
        $message = $this->userInterface->getAvailableMessage($userList);
        return view('user.userlist')->with('userList', $userList)->with('message', $message);
    }
    /**
     * list of user by search keyword
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $createdFrom = $request->input('createdfrom');
        $createdTo = $request->input('createdto');
        $userList = $this->userInterface->getSearchUser($name, $email, $createdFrom, $createdTo);
        $message = $this->userInterface->getAvailableMessage($userList);
        return view('user.userlist')->with('userList', $userList)
            ->with('name', $name)
            ->with('email', $email)
            ->with('createdFrom', $createdFrom)
            ->with('createdTo', $createdTo)->with('message', $message);
    }
    /**
     * show user profile
     */
    public function profile()
    {
        $user = Auth::user();
        if ($user->type == 0) {
            $user->type = "Admin";
        } else {
            $user->type = "User";
        }
        return view('user.userprofile')->with('user', $user);
    }
    /**
     * create user
     * @return \Illuminate\Http\Response
     */
    public function createUser()
    {
        return view('user.createuser');
    }
    /**
     * confirm create
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function confirmCreate(UserRequest $request)
    {
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = $request->password;
        $user['type'] = $request->type;
        $user['dob'] = $request->dob;
        $user['phone'] = $request->phone;
        $user['address'] = $request->address;
        $destination_path = 'public/uploads';
        $image = $request->file('profile');
        $image_name = $image->getClientOriginalName();
        $path = $request->file('profile')->storeAs($destination_path, $image_name);
        $user['profile'] = $image_name;
        return view('user.confirmcreate')->with('user', $user);
    }
    /**
     * save user
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $existenceUser = $this->authInterface->getUserByEmail($request->input('email'));
        if (StringUtil::isNotEmpty($existenceUser)) {
            return view('user.createuser')->with('duplicate', true)->with('user', $existenceUser);
        } else {
            $this->userInterface->saveUser($request);
            return redirect()->route('users#index');
        }
    }
    /**
     * edit user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function updateUser($id)
    {
        $user = $this->userInterface->getUserById($id);
        if ($user->type == 0) {
            $user->type = "Admin";
        } else {
            $user->type = "User";
        }
        return view('user.edituser')->with('user', $user);

    }
    /**
     * confirm edit
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function confirmUpdate(UserRequest $request, $id)
    {
        $user = User::find($id);
        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['type'] = $request->type;
        $user['phone'] = $request->phone;
        $user['dob'] = $request->dob;
        $user['address'] = $request->address;
        if ($request->hasFile('profile')) {
            $oldProfile = $user->profile;
            $oldImage = file_exists(public_path() . '/storage/uploads/' . $oldProfile);
            if ($oldImage) {
                Storage::delete('/public/uploads/' . $oldProfile);
            }
            $destination_path = 'public/uploads';
            $image = $request->file('profile');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('profile')->storeAs($destination_path, $image_name);
            $user['profile'] = $image_name;
            return view('user.confirmedit')->with('user', $user);
        }
    }
    /**
     * updated user
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function updated(Request $request, $id)
    {
        $duplicate = $this->userInterface->duplicateUser($request);
        $userRequest = $this->userInterface->getUserByEmail($request->email);
        if ($duplicate && $userRequest->id . "" != $id) {
            $userRequest->id = $id;
            return view('user.edituser')->with('duplicate', $duplicate)->with('user', $userRequest);
        } else {
            $user = $this->userInterface->updateUser($request, $id);
            if (Gate::allows('isUser')) {
                return redirect()->route('users#profile');
            } else {
                return redirect()->route('users#index');
            }
        }
    }
    /**
     * delete user
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser($id)
    {
        $this->userInterface->deleteUser($id);
        return redirect()->route('users#index');
    }
}
