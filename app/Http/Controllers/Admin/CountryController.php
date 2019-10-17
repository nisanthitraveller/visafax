<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
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
        $countryObj = new Country();
        $countries = $countryObj->all();
        $status = ['In active', 'Active'];
        return view('admin.countries')->with(['countries' => $countries, 'status' => $status]);
    }
    
    public function editcountry($Id, Request $request)
    {
        $country = Country::where("id", $Id)->first();
        unset($country['created_at']);
        unset($country['updated_at']);
        unset($country['id']);
        if(!empty($request['countryName'])) {
            $model = Country::findOrFail($Id);
            $model->fill($request->toArray());
            $model->save();
            return redirect('/bo/countries')->with('status', 'Country updated!');
        }
        
        return view('admin.editcountry')->with(['country' => $country]);
    }
}
