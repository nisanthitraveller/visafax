<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\PricingMaster;
use Illuminate\Http\Request;

class PricingController extends Controller
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

    public function pricingtypes()
    {
        $pricingTypeObj = new PricingMaster();
        $pricingTypes = $pricingTypeObj->getList();
        return view('admin.pricingtypes')->with(['pricingTypes' => $pricingTypes]);
    }
    
    public function editpricingtype($Id, Request $request)
    {
        $pricingType = PricingMaster::where("id", $Id)->first()->toArray();
        $destinationPath = 'uploads';
        unset($pricingType['id']);
        unset($pricingType['created_at']);
        unset($pricingType['updated_at']);
        $uploadedFile = null;
        if ($request->hasFile('icon')) {
            $flightFile = $request->file('icon');
            $flightFile->move($destinationPath, str_replace(' ', '', $flightFile->getClientOriginalName()));
            $uploadedFile = str_replace(' ', '', $flightFile->getClientOriginalName());
        }
        if(!empty($request['title'])) {
            $model = PricingMaster::findOrFail($Id);
            $model->fill($request->toArray());
            if($uploadedFile != null) {
                $model->icon = $uploadedFile;
            }
            $model->save();
            return redirect('/bo/pricingtypes')->with('status', 'Pricing updated!');
        }
        
        return view('admin.editpricing')->with(['pricingType' => $pricingType]);
    }
    
    public function addpricingtype(Request $request)
    {
        $destinationPath = 'uploads';
        $pricingTypeObj = new PricingMaster();
        $uploadedFile = null;
        if(!empty($request['title'])) {
            if ($request->hasFile('icon')) {
                $flightFile = $request->file('icon');
                $flightFile->move($destinationPath, str_replace(' ', '', $flightFile->getClientOriginalName()));
                $uploadedFile = str_replace(' ', '', $flightFile->getClientOriginalName());
            }
            
            $pricingTypeObj->title = request('title');
            $pricingTypeObj->description = request('description');
            $pricingTypeObj->default_price = request('default_price');
            if($uploadedFile != null) {
                $pricingTypeObj->icon = $uploadedFile;
            }
            $pricingTypeObj->save();
            return redirect('/bo/pricingtypes')->with('status', 'Created!');
        }
        
        return view('admin.addpricing');
    }
}
