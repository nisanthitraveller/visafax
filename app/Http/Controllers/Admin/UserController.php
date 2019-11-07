<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\UserInfo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $user;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/bo/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function get()
    {
        $userInfoObj = new UserInfo();
        $users = $userInfoObj->getList();
        return view('admin.users')->with(['users' => $users]);
    }
    
    public function enquiries()
    {
        $userObj = new User();
        $users = $userObj->all();
        return view('admin.enquiries')->with(['users' => $users]);
    }
    
    public function edituser($userId, Request $request)
    {
        $user = UserInfo::where("id", $userId)->first()->toArray();
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['user_id']);
        unset($user['id']);
        if(!empty($request['FirstName'])) {
            $model = UserInfo::findOrFail($userId);
            $data = $request->toArray();
            $data['PassportDOI'] = implode("-", array_reverse(explode("/", $data['PassportDOI'])));
            $data['PassportDOE'] = implode("-", array_reverse(explode("/", $data['PassportDOE'])));
            $data['DOB'] = implode("-", array_reverse(explode("/", $data['DOB'])));
            $model->fill($data);
            $model->save();
            return redirect()->back();
        }
        
        return view('admin.edituser')->with(['user' => $user]);
    }
}
