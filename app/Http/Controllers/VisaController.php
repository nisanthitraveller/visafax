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
        $countryPrices = Pricing::where('country_id', $booking['VisitingCountry'])->with('master')->select('plan_id', 'price')->orderBy('plan_id', 'asc')->get()->toArray();
        return view('payment')->with(['bookingId' => $bookingId, 'payLater' => $payLater, 'countryPrices' => $countryPrices]);
    }
    
    public function step1($bookingId, Request $data)
    {
        $bookingObj = new Bookings();
        $visaObj = new Visa();
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
        $visaDetails = $visaObj->getVisa($bookingId);
        return view('step1')->with(['bookingId' => $bookingId, 'response' => $response, 'visaDetails' => $visaDetails]);
    }
    
    public function step2($bookingId, Request $request)
    {
        $visaObj = new Visa();
        $documentTypes = \App\Models\DocumentType::select(['id', 'type'])->get()->toArray();
        $data = [];
        foreach($documentTypes as $documentType) {
            $data[$documentType['id']] = $documentType['type'];
        }
        
        $visaDetails = $visaObj->getVisa($bookingId);
        $visaDetails = json_decode(json_encode($visaDetails), true);
        $destinationPath = 'uploads';
        if ($request->hasFile('flightfile')) {
            
            $flightFiles = $request->file('flightfile');
            $key = array_search('Flight Tickets', $data);
            foreach($visaDetails as $k => $visaDetail) {
                $flightFiles[$k]->move($destinationPath, $k . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $flightFiles[$k]->getClientOriginalName()));
                $visaObj->uploadFile($k . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $flightFiles[$k]->getClientOriginalName()), 'flights', $visaDetail['id'], $key);
            }
        }
        if ($request->hasFile('hotelfile')) {
            $hotelFiles = $request->file('hotelfile');
            $key1 = array_search('Hotel Vouchers', $data);
            foreach($visaDetails as $k1 => $visaDetail) {
                $hotelFiles[$k1]->move($destinationPath, $k1 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $hotelFiles[$k1]->getClientOriginalName()));
                $visaObj->uploadFile($k1 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $hotelFiles[$k1]->getClientOriginalName()), 'hotels', $visaDetail['id'], $key1);
            }
        }
        
        return view('step2')->with(['bookingId' => $bookingId, 'visaDetails' => $visaDetails]);
    }
    
    public function step3($bookingId, Request $request)
    {
        $visaObj = new Visa();
        $user = auth()->user();
        $documentTypes = \App\Models\DocumentType::select(['id', 'type'])->get()->toArray();
        $data = [];
        foreach($documentTypes as $documentType) {
            $data[$documentType['id']] = $documentType['type'];
        }
        
        $visaDetails = $visaObj->getVisa($bookingId);
        $visaDetails = json_decode(json_encode($visaDetails), true);
        $destinationPath = 'uploads';
        
        if ($request->hasFile('offer_letter')) {
            $flightFiles = $request->file('offer_letter');
            
            $key = array_search('Offer Letter', $data);
            foreach($visaDetails as $k => $visaDetail) {
                $flightFiles[$k]->move($destinationPath, $k . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $flightFiles[$k]->getClientOriginalName()));
                $visaObj->uploadFile($k . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $flightFiles[$k]->getClientOriginalName()), 'offer_letter', $visaDetail['visaID'], $key);
            }
        }
        
        if ($request->has('address_proof')) {
            foreach($visaDetails as $k => $visaDetail) {
                $visaObj->updateAddress($user->id, $request['address_proof'], $visaDetail['visaID']);
            }
        }
        
        if ($request->hasFile('firstpage')) {
            $firstFiles = $request->file('firstpage');
            $key1 = array_search('Passport Copies', $data);
            
            foreach($visaDetails as $k1 => $visaDetail) {
                $firstFiles[$k1]->move($destinationPath, $k1 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $firstFiles[$k1]->getClientOriginalName()));
                $visaObj->uploadFile($k1 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $firstFiles[$k1]->getClientOriginalName()), 'passport', $visaDetail['visaID'], $key1);
            }
        }
        if ($request->hasFile('lastpage')) {
            $lastFiles = $request->file('lastpage');
            $key2 = array_search('Passport Copies', $data);
            foreach($visaDetails as $k2 => $visaDetail) {
                $lastFiles[$k2]->move($destinationPath, $k2 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $lastFiles[$k2]->getClientOriginalName()));
                $visaObj->uploadFile($k2 . $visaDetail['BookingID'] . '-' . str_replace(' ', '', $lastFiles[$k2]->getClientOriginalName()), 'passport', $visaDetail['visaID'], $key2);
            }
        }
        
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
        
        $response['payStat'] = null;
        
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
        
        
        return view('dashboard')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response]);
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
}
