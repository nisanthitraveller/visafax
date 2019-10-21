<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\Country;
use \App\Models\DocumentType;
use \App\Models\Document;
use \App\Models\PricingMaster;
use \App\Models\Pricing;

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
    
    public function countrydocument($Id, Request $request)
    {
        
        $documentTypeObj = new DocumentType();
        $documentTypes = $documentTypeObj->getList();
        $countryDocuments = Document::where('country_id', $Id)->select('document_type', 'document_id')->get()->toArray();
        $documentTypeId = [];
        $driveId = [];
        foreach($countryDocuments as $key => $countryDocument) {
            $documentTypeId[$key] = $countryDocument['document_type'];
            $driveId[$key] = $countryDocument['document_id'];
        }
        
        $country = Country::where("id", $Id)->first();
        if(!empty($request['countryName'])) {
            $docIds = $request['document_id'];
            //echo '<pre>';print_r($request['document_type']);
            //print_r($documentTypeId);
            //echo '</pre>';
            //dd($docIds);
            // Delete unselected values
            Document::whereNotIn('id', $request['document_type'])->where('country_id', $Id)->delete(); 
            
            foreach($request['document_type'] as $k => $documentType) {
                
                $findRow = Document::where('country_id', $Id)->where('document_type', $documentType)->first();
                if($findRow) {
                    $findRow->document_id = $docIds[$k];
                    $findRow->save();
                } else {
                    $documentObj = new Document();
                    $documentObj->country_id = request('country_id');
                    $documentObj->document_type = $documentType;
                    $documentObj->document_id = isset($docIds[$k]) ? $docIds[$k] : null;
                    $documentObj->status = 1;
                    $documentObj->save();
                }
                
            }
            return redirect('/bo/countries')->with('status', 'Country updated!');
        }
        
        return view('admin.countrydocument')->with(['country' => $country, 'documentTypes' => $documentTypes, 'documentTypeId' => $documentTypeId, 'driveId' => $driveId]);
    }
    
    public function countryprice($Id, Request $request)
    {
        $pricingTypeObj = new PricingMaster();
        $pricingTypes = $pricingTypeObj->getList();
        $countryPrices = Pricing::where('country_id', $Id)->select('plan_id', 'price')->get()->toArray();
        $priceId = [];
        $price = [];
        foreach($countryPrices as $key => $countryDocument) {
            $priceId[$key + 1] = $countryDocument['plan_id'];
            $price[$key + 1] = $countryDocument['price'];
        }
        //dd($countryDocuments);
        $country = Country::where("id", $Id)->first();
        if(!empty($request['countryName'])) {
            $docIds = array_values(array_filter($request['price']));
            // Delete unselected values
            Pricing::whereNotIn('id', $request['plan_id'])->where('country_id', $Id)->delete(); 
            
            foreach($request['plan_id'] as $k => $documentType) {
                
                $findRow = Pricing::where('country_id', $Id)->where('plan_id', $documentType)->first();
                if($findRow) {
                    $findRow->price = $docIds[$k];
                    $findRow->save();
                } else {
                    $pricingObj = new Pricing();
                    $pricingObj->country_id = request('country_id');
                    $pricingObj->plan_id = $documentType;
                    $pricingObj->price = $docIds[$k];
                    $pricingObj->save();
                }
                
            }
            return redirect('/bo/countries')->with('status', 'Country updated!');
        }
        
        return view('admin.countryprice')->with(['country' => $country, 'pricingTypes' => $pricingTypes, 'priceId' => $priceId, 'price' => $price]);
    }
}
