<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\UserInfo;
use Illuminate\Http\Request;
use Mail;

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
    
    public function enquiries(Request $request)
    {
        if(!empty($request['first_name'])) {
            $model = new User();
            $request['name'] = $request['first_name'] . ' ' . $request['last_name'];
            $request['password'] = \Illuminate\Support\Facades\Hash::make('123456');
            $userId = $model->insertGetId($request->toArray());
            //$model->save();
            $auth = User::findOrFail($userId);
            
            
            // Send mail to User
            Mail::send('mail.create-visa', ['user' => $auth], function($message) use($auth) {
                $message->from('operations@visabadge.com', 'Operations VisaBadge');
                $message->to($auth->email, $auth->name)
                        ->bcc('operations@visabadge.com')
                        ->bcc('shiju.radhakrishnan@visabadge.com')
                        ->bcc('shiju.radhakrishnan@itraveller.com')
                        ->bcc('nisanth.kumar@itraveller.com')
                        ->subject($auth->name . ', this is about your visa application');
            });
            
            return redirect()->back();
        }
        $users = User::orderBy('created_at', 'desc')->get();
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
    
    public function editenquiry($userId, Request $request)
    {
        $user = User::where("id", $userId)->select('first_name', 'last_name', 'email', 'phone')->first()->toArray();
        if(!empty($request['first_name'])) {
            $model = User::findOrFail($userId);
            $data = $request->toArray();
            $data['name'] = $request['first_name'] . ' ' . $request['last_name'];
            $model->fill($data);
            $model->save();
            return redirect()->back();
        }
        
        return view('admin.editenquiry')->with(['user' => $user]);
    }
    
    public function deleteenquiry($userId)
    {
        $userList = UserInfo::where("user_id", $userId)->select('id')->get();
        foreach($userList as $childUser) {
            $bookings = \App\Models\Bookings::where("user_id", $childUser->id)->with('child')->select('id')->get()->toArray();
            foreach($bookings as $booking) {
                \App\Models\BookingDocument::where("BookingID", $booking['id'])->delete();
                if(!empty($booking['child'])) {
                    foreach($booking['child'] as $childBooking) {
                        \App\Models\BookingDocument::where("BookingID", $childBooking['id'])->delete();
                    }
                }
            }
            \App\Models\Bookings::where("user_id", $childUser->id)->with('child')->delete();
        }
        UserInfo::where("user_id", $userId)->delete();
        User::where("id", $userId)->delete();
        
        return redirect('/bo/enquiries');
    }
}
