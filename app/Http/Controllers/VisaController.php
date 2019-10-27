<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Visa;
use App\Models\Bookings;
use Jenssegers\Agent\Agent;
use Mail;

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
        $booking = Bookings::where("id", $bookingId)->with('child')->first()->toArray();
        $countryPrices = Pricing::where('country_id', $booking['VisitingCountry'])->with('master')->select('plan_id', 'price')->orderBy('plan_id', 'asc')->get()->toArray();
        return view('payment')->with(['bookingId' => $bookingId, 'payLater' => $payLater, 'countryPrices' => $countryPrices, 'booking' => $booking]);
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
            
            //if($data['udf2'] == true) {
                return redirect('/dashboard')->with(['bookingId' => $bookingId, 'response' => $response]);
            //}
        }
        //$visaDetails = $visaObj->getVisa($bookingId);
        //return view('step1')->with(['bookingId' => $bookingId, 'response' => $response, 'visaDetails' => $visaDetails]);
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
        $booking = Bookings::where("id", 1)->with('user')->with('child')->first()->toArray();
        Mail::send('mail.mail-assign', ['booking' => $booking], function($message) use($booking) {
            $message->from('operations@visabadge.com', 'Operations VisaBadge');
            $message->to('shiju.radhakrishnan@itraveller.com', $booking['user']['FirstName'] .' ' . $booking['user']['Surname'])
                    ->cc('operations@visabadge.com')
                    ->bcc(['shiju.radhakrishnan@itraveller.com', 'nisanth.kumar@itraveller.com'])
                    ->subject('VisaBadge: Document generated for Booking ID ' . $booking['BookingID']);
        });
    }
    
    public function dashboard(Request $request) {
        $visaObj = new Visa();
        $user = auth()->user();
        $agent = new Agent();
        $allVisa = $visaObj->getAllMyVisa($user->id);
        $allVisa = json_decode(json_encode($allVisa), True);
        $destinationPath = 'uploads';
        $bookingId = isset($allVisa[0]) ? $allVisa[0]['id'] : null;
        if($request['bookingID']) {
            $bookingId = $request['bookingID'];
        }
        
        if($request['docType']) {
            \App\Models\BookingDocument::where('BookingID', $request['visaID'])->where('DocumentID', $request['docType'])->delete();
            $pdfFiles = $request->file('booking_documents');
            foreach($pdfFiles as $pdfFile) {
                $pdfFile->move($destinationPath, time() . $request['visaID'] . '-' . str_replace(' ', '', $pdfFile->getClientOriginalName()));
                \App\Models\BookingDocument::insert([
                    'DocumentID' => $request['docType'],
                    'BookingID' => $request['visaID'],
                    'pdf' => time() . $request['visaID'] . '-' . str_replace(' ', '', $pdfFile->getClientOriginalName())
                ]);
            }
            return redirect()->back();
        }
        
        $response['payStat'] = null;
        $documents = $booking = [];
        if($bookingId != null) {
            $booking = \App\Models\Bookings::where("id", $bookingId)->with('user')->with('child')->first()->toArray();

            $assignedDocuments = \App\Models\BookingDocument::where('BookingID', $bookingId)->with('documenttype')->get()->toArray();


            foreach ($assignedDocuments as $assignedDocument) {
                $documents[$assignedDocument['DocumentID']][] = $assignedDocument;
            }
        }
        if($agent->isMobile() && isset($request['bookingID'])) {
            return view('dashboard-mobile')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response, 'request' => $request]);
        } else {
            return view('dashboard')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response, 'request' => $request]);
        }
        //dd($documents);
        
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
}
