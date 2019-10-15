<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Visa;

class VisaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function payment($bookingId)
    {
        $payLater = request('paylater') ? false : true;
        return view('payment')->with(['bookingId' => $bookingId, 'payLater' => $payLater]);
    }
    
    public function step1($bookingId)
    {
        return view('step1')->with(['bookingId' => $bookingId]);
    }
    
    public function step2($bookingId, Request $request)
    {
        $visaObj = new Visa();
        $destinationPath = 'uploads';
        if ($request->hasFile('flightfile')) {
            $flightFile = $request->file('flightfile');
            $flightFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $flightFile->getClientOriginalName()));
            $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $flightFile->getClientOriginalName()), 'flights', $bookingId);
        }
        if ($request->hasFile('hotelfile')) {
            $hotelFile = $request->file('hotelfile');
            $hotelFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $hotelFile->getClientOriginalName()));
            $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $hotelFile->getClientOriginalName()), 'hotels', $bookingId);
        }
        $visaDetails = $visaObj->getVisa($bookingId);
        return view('step2')->with(['bookingId' => $bookingId, 'visaDetails' => $visaDetails]);
    }
    
    public function step3($bookingId, Request $request)
    {
        $visaObj = new Visa();
        $destinationPath = 'uploads';
        
        if ($request->hasFile('offer_letter')) {
            $flightFile = $request->file('offer_letter');
            $flightFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $flightFile->getClientOriginalName()));
            $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $flightFile->getClientOriginalName()), 'offer_letter', $bookingId);
        }
        if ($request->hasFile('address_proof')) {
            $hotelFile = $request->file('address_proof');
            $hotelFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $hotelFile->getClientOriginalName()));
            $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $hotelFile->getClientOriginalName()), 'address_proof', $bookingId);
        }
        
        if ($request->has('address_proof')) {
            $visaObj->uploadFile(null, $request['address_proof'], $bookingId);
        }
        
        if ($request->hasFile('firstpage')) {
            $firstFiles = $request->file('firstpage');
            foreach($firstFiles as $firstFile) {
                $firstFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $firstFile->getClientOriginalName()));
                $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $firstFile->getClientOriginalName()), 'passport', $bookingId, 'first_page');
            }
        }
        if ($request->hasFile('lastpage')) {
            $lastFiles = $request->file('lastpage');
            foreach($lastFiles as $lastFile) {
                $lastFile->move($destinationPath, $bookingId . '-' . str_replace(' ', '', $lastFile->getClientOriginalName()));
                $visaObj->uploadFile($bookingId . '-' . str_replace(' ', '', $lastFile->getClientOriginalName()), 'passport', $bookingId, 'last_page');
            }
        }
        
        
        $visaDetails = $visaObj->getVisa($bookingId);
        return view('step3')->with(['bookingId' => $bookingId, 'visaDetails' => $visaDetails]);
    }
    
    public function testvisa() {
        $visaObj = new Visa();
        $visaDetails = $visaObj->getVisa(1);
        dd($visaDetails);
    }
    
    public function dashboard(Request $request) {
        $visaObj = new Visa();
        $googleController = new App\Http\Controllers\GoogleController();
        $user = auth()->user();
        
        $allVisa = $visaObj->getAllMyVisa($user->id);
        $bookingId = $allVisa[0]['id'];
        if($request['bookingID']) {
            $bookingId = $request['bookingID'];
        }
        
        $client = $googleController->getClient();
        $service = new \Google_Service_Drive($client);
        
        $visaDetails = $visaObj->getVisa($bookingId);
        
        if($visaDetails[0]['user_id'] != $user->id) {
            die('No booking found!');
        }
        
        foreach ($visaDetails as $key => $visaDetail) {
            $foldID = $visaDetail->folderID;    

            $files[$key] = $googleController->retrieveAllFiles($service, $foldID);
        }
        dd($files);
        return view('dashboard')->with(['allVisa' => $allVisa, 'files' => $files]);
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
}
