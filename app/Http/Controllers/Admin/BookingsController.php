<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\Bookings;
use Illuminate\Http\Request;

class BookingsController extends Controller
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
        $bookingObj = new Bookings();
        $bookings = $bookingObj->getList();
        return view('admin.bookings')->with(['bookings' => $bookings]);
    }
    
    public function editbooking($bookingId, Request $request)
    {
        $user = Bookings::where("id", $bookingId)->first()->toArray();
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['user_id']);
        unset($user['id']);
        if(!empty($request['VisaType'])) {
            $model = Bookings::findOrFail($bookingId);
            $model->fill($request->toArray());
            $model->save();
            return redirect()->back();
        }
        
        return view('admin.editbooking')->with(['user' => $user]);
    }
}
