<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Visa;
use App\Models\Bookings;
use Google_Client;

class VisaController extends Controller
{
    //private $projectName = 'VisaBadge';
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
        $booking = Bookings::where("id", $bookingId)->first()->toArray();
        $countryPrices = Pricing::where('country_id', $booking['VisitingCountry'])->with('master')->select('plan_id', 'price')->get()->toArray();
        return view('payment')->with(['bookingId' => $bookingId, 'payLater' => $payLater, 'countryPrices' => $countryPrices]);
    }
    
    public function step1($bookingId, Request $data)
    {
        $bookingObj = new Bookings();
        $response['payStat'] = null;
        if (isset($data['mihpayid'])) {
            if ($data['status'] == 'success') {
                $response['paid'] = 1;
                $response['payStat'] = 'Payment Success';
            } else {
                $response['paid'] = 0;
                $response['payStat'] = 'Payment Failed';
            }
            
            $response['plan_id'] = $data['udf1'];
            $response['payment_response'] = 'Online Payment (PayU) [' . $data['mode'] . ']';
            $response['payment_date'] = date('Y-m-d H:i:s');
            $response['amount_paid'] = $data['amount'];
            
            $bookingObj->updatePayment($bookingId, $response);
            
            if($data['udf2'] == true) {
                return redirect('/dashboard')->with(['bookingId' => $bookingId, 'response' => $response]);
            }
        }
        return view('step1')->with(['bookingId' => $bookingId, 'response' => $response]);
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
        $user = auth()->user();
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
            $visaObj->updateAddress($user->id, $request['address_proof'], $bookingId);
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
        $user = auth()->user();
        
        $allVisa = $visaObj->getAllMyVisa($user->id);
        $allVisa = json_decode(json_encode($allVisa), True);
        $bookingId = $allVisa[0]['id'];
        if($request['bookingID']) {
            $bookingId = $request['bookingID'];
        }
        
        $booking = \App\Models\Bookings::where("id", $bookingId)->with('child')->first()->toArray();
        
        $assignedDocuments = \App\Models\BookingDocument::where('BookingID', $bookingId)->get()->toArray();
        $documents = [];
        foreach ($assignedDocuments as $assignedDocument) {
            $documentType = \App\Models\DocumentType::where('id', $assignedDocument['DocumentID'])->first()->toArray();
            $documents[$assignedDocument['DocumentID']]['status'] = $assignedDocument['status'];
            $documents[$assignedDocument['DocumentID']]['type'] = $documentType['type'];
            $documents[$assignedDocument['DocumentID']]['drive'] = false;
            if($assignedDocument['DriveId'] != null) {
                $documents[$assignedDocument['DocumentID']]['link'] = 'https://docs.google.com/document/d/' . $assignedDocument['DriveId'];
                $documents[$assignedDocument['DocumentID']]['drive'] = true;
            } else if($assignedDocument['pdf'] != null) {
                $documents[$assignedDocument['DocumentID']]['link'] = url('/') . '/uploads/' . $assignedDocument['pdf'];
            } else {
                $documents[$assignedDocument['DocumentID']]['link'] = '#';
            }
        }
        
        
        return view('dashboard')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents]);
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
}
