<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pricing;
use App\Models\Visa;
use App\Models\Bookings;
use Jenssegers\Agent\Agent;
use Mail;
use App\Models\Country;
use Aws\Textract\TextractClient;
use AWS;

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
        //$this->middleware('auth');
        $this->middleware('auth', ['except' => ['countrydashboard', 'startvisa']]);
    }
    
    public function payment($bookingId)
    {
        $payLater = request('paylater') ? false : true;
        $booking = Bookings::where("id", $bookingId)->with('child')->with('documents')->first()->toArray();
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
                return redirect('/dashboard?bookingID=' . $bookingId)->with(['bookingId' => $bookingId, 'response' => $response]);
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
        phpinfo();
    }
    
    public function dashboard(Request $request) {
        $visaObj = new Visa();
        $user = auth()->user();
        $agent = new Agent();
        
        $client = new TextractClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'aws_access_key_id' => env('AWS_ACCESS_KEY_ID'),
            'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        ]);
        
        $allVisa = $visaObj->getAllMyVisa($user->id);
        $allVisa = json_decode(json_encode($allVisa), True);
        $users = \App\Models\UserInfo::where("user_id", $user->id)->select('id')->get()->toArray();
        $userIds = array_column($users, 'id');
        $destinationPath = 'uploads';
        $bookingId = isset($allVisa[0]) ? $allVisa[0]['id'] : null;
        if($request['bookingID']) {
            $bookingId = $request['bookingID'];
        }
        if($request['save_booking_id']) {
            $bookingId = $request['save_booking_id'];
        }
        
        $mobile = false;
        
        $response['payStat'] = null;
        $documents = $booking = [];
        if($bookingId != null) {
            $booking = \App\Models\Bookings::where("id", $bookingId)->with('documents')->with('user')->with('child')->first()->toArray();
            if(!in_array($booking['user_id'], $userIds)) {
                return redirect('/dashboard');
            }
            $assignedDocuments = \App\Models\BookingDocument::where('BookingID', $bookingId)->with('document')->with('documenttype')->get()->toArray();
            foreach ($assignedDocuments as $assignedDocument) {
                $documents[$assignedDocument['DocumentID']][] = $assignedDocument;
            }
        }
        $jobId = null;
        
        if($request['save_booking_id']) {
            
            $model = Bookings::findOrFail($request['save_booking_id']);
            $data = $request['booking'];
            if(!empty($data['JoiningDate'])) {
                $data['JoiningDate'] = implode("-", array_reverse(explode("/", $data['JoiningDate'])));
            } 
            if(!empty($data['payment_date'])) {
                $data['payment_date'] = implode("-", array_reverse(explode("/", $data['payment_date'])));
            }
            if(!empty($data['status']) && $data['status'] == 2) {
                $data['verified_at'] = date('Y-m-d');
            }
            if(!empty($data['status']) && $data['status'] == 3) {
                $data['submission_at'] = date('Y-m-d');
            }
            if(!empty($data['status']) && $data['status'] == 4) {
                $data['approval_at'] = date('Y-m-d');
            }
            $data['status'] = 1;
            foreach ($data as $k => $d) {
                if(empty($d)) {
                    $data[$k] = 'Enter' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $k);
                }
            }
            $model->fill($data);
            $model->save();
        }
        
        if($request['save_user_id']) {
            $modelUser = \App\Models\UserInfo::findOrFail($request['save_user_id']);
            $dataUser = $request['user'];
            $dataUser['PassportDOI'] = implode("-", array_reverse(explode("/", $dataUser['PassportDOI'])));
            $dataUser['PassportDOE'] = implode("-", array_reverse(explode("/", $dataUser['PassportDOE'])));
            $dataUser['DOB'] = implode("-", array_reverse(explode("/", $dataUser['DOB'])));
            foreach ($dataUser as $k1 => $d1) {
                if(empty($d1)) {
                    $dataUser[$k1] = 'Enter' . preg_replace('/(?<!\ )[A-Z]/', ' $0', $k1);
                }
            }
            $modelUser->fill($dataUser);
            $modelUser->save();
        }
        if($request['save_user_id'] || $request['save_booking_id']) { 
            Mail::send('mail.mail-assign-doc', ['request' => $request], function($message) use($request) {
                $message->from('operations@visabadge.com', 'Operations VisaBadge');
                $message->to('operations@visabadge.com', 'VB Operarons')
                        ->cc('shiju.radhakrishnan@visabadge.com')
                        ->bcc(['nisanth.kumar@itraveller.com'])
                        ->subject('VisaBadge: Assign doc for Booking ID VB' . $request['save_booking_id']);
            });
            return response()->json([
                'message'   => 'Data saved Successfully',
                'class_name'  => 'alert-success',
                'redirect' => 1
            ]);
        }
        if($request['docType']) {
            \App\Models\BookingDocument::where('BookingID', $request['visaID'])->where('DocumentID', $request['docType'])->delete();
            $documentType = \App\Models\DocumentType::where('id', $request['docType'])->first()->toArray();
            $pdfFiles = $request->file('booking_documents');
            foreach($pdfFiles as $pdfFile) {
                $fileName = time() . $request['visaID'] . '-' . str_replace(' ', '', $pdfFile->getClientOriginalName());
                $pdfFile->move($destinationPath, $fileName);
                \App\Models\BookingDocument::insert([
                    'DocumentID' => $request['docType'],
                    'BookingID' => $request['visaID'],
                    'pdf' => $fileName
                ]);
                if($request['totaluploadType']) {
                    $s3 = new \Aws\S3\S3Client([
                            'region'  => env('AWS_DEFAULT_REGION'),
                            'version' => 'latest',
                            'credentials' => [
                                'key'    => env('AWS_ACCESS_KEY_ID'),
                                'secret' => env('AWS_SECRET_ACCESS_KEY'),
                            ]
                    ]);	
                    $s3->putObject(array(
                        'Bucket'     => env('AWS_BUCKET'),
                        'Key'        => $fileName,
                        'SourceFile' => $destinationPath . '/' . $fileName,
                        'ContentType' => 'application/pdf'
                    ));

                    $result = $client->startDocumentAnalysis([
                        'DocumentLocation' => [ // REQUIRED
                            'S3Object' => [
                                'Bucket' => 'visabadge-bucket',
                                'Name' => $fileName
                            ],
                        ],
                        'FeatureTypes' => ['TABLES', 'FORMS'], // REQUIRED
                    ]);
                    $data = $result->toArray();
                    $jobId[] = $data['JobId'];
                }
            }
            
            Mail::send('mail.mail-upload', ['booking' => $booking, 'documentType' => $documentType], function($message) use($booking) {
                $message->from('operations@visabadge.com', 'Operations VisaBadge');
                $message->to('operations@visabadge.com', 'VB Operarons')
                        ->cc('shiju.radhakrishnan@visabadge.com')
                        ->bcc(['nisanth.kumar@itraveller.com'])
                        ->subject('VisaBadge: Document uploaded for Booking ID ' . $booking['BookingID']);
            });
            return response()->json([
                'message'   => $documentType['type'] . ' Upload Successfully',
                'class_name'  => 'alert-success',
                'JobId' => $jobId,
                'redirect' => 0
            ]);
        }
        
        if($agent->isMobile()) {
            $mobile = true;
        }
        //if($request->is('dashboard')) {
        //    if($agent->isMobile() && isset($request['bookingID'])) {
        //        return view('dashboard-mobile')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response, 'request' => $request]);
        //    } else {
        //        return view('dashboard')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response, 'request' => $request, 'mobile' => $mobile]);
        //    }
        //} else {
        $uploadedDocs = [];
        $countryDocs = [];
        if(isset($booking['documents'])) {
            foreach($booking['documents'] as $doc) {
                if(!empty($doc['pdf'])) {
                    $uploadedDocs[] = $doc['DocumentID'];
                }
            }
        }
        $countryDocuments = \App\Models\Document::where('country_id', $booking['VisitingCountry'])->where('display', 1)->with('documenttype')->select('document_type', 'document_id', 'pdf', 'body_business as tooltip', 'display')->orderBy('display', 'DESC')->get()->toArray();
        foreach($countryDocuments as $countryDoc) {
            $countryDocs[] = $countryDoc['document_type'];
        }
        $arrayDiff = array_values(array_diff($countryDocs, $uploadedDocs));
        //$concat = (strpos( $request->getRequestUri(), '?' ) !== false) ? '&' : '?';
        
        //if(!empty($arrayDiff) && !isset($request['uploadType']) && $booking['status'] == 0) {
        //    return redirect($request->getRequestUri() . $concat . 'uploadType=' . $arrayDiff[0]);
        //} else if(empty($arrayDiff) && !isset($request['uploadType']) && $booking['status'] == 0 && !isset($request['form'])) {
        //    return redirect($request->getRequestUri() . $concat . 'form=1');
        //} else {
            return view('dashboard-new')->with(['allVisa' => $allVisa, 'visaDetails' => $booking, 'documents' => $documents, 'response' => $response, 'request' => $request, 'mobile' => $mobile, 'countryDocuments' => $countryDocuments, 'arrayDiff' => $arrayDiff]);
        //}
        //}
        
        
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
    
    public function countrydashboard($visaUrl, Request $request) {
        $visaUrl = str_replace('-visa', '', $visaUrl);
        $country = Country::where("countryName", str_replace('-', ' ', $visaUrl))->first()->toArray();
        
        $countryDocuments = \App\Models\Document::where('country_id', $country['id'])->with('documenttype')->select('document_type', 'document_id', 'pdf', 'body_business as tooltip', 'display')->orderBy('display', 'DESC')->get()->toArray();
        return view('dashboard-country')->with(['countryDocuments' => $countryDocuments, 'request' => $request, 'country' => $country]);
        
    }
    
    public function startvisa($visaUrl, Request $request) {
        $visaUrl = str_replace('-visa', '', $visaUrl);
        $country = Country::where("countryName", str_replace('-', ' ', $visaUrl))->first()->toArray();
        if(!empty($request['PassportNo'])) {
            
            $dataUser = $request->toArray();
            unset($dataUser['visaType']);
            unset($dataUser['persons']);
            unset($dataUser['vistingCountry']);
            unset($dataUser['residenceCountry']);
            $newUser = \App\User::create([
                'name' => $dataUser['Surname'],
                'first_name' => $dataUser['FirstName'],
                'last_name' => $dataUser['Surname'],
                'email' => $dataUser['EmailID'],
                'provider' => 'google-test',
                'provider_id' => 0,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'avatar' => 'https://visabadge.com/images/avat.svg',
            ]);
            
            $dataUser['user_id'] = $newUser->id;
            $dataUser['PassportDOE'] = implode("-", array_reverse(explode("/", $dataUser['PassportDOE'])));
            $dataUser['DOB'] = implode("-", array_reverse(explode("/", $dataUser['DOB'])));
            $modelUser = \App\Models\UserInfo::create($dataUser);
            
            $bookingID = (strlen($modelUser->id + 1) < 3) ? 'VB' . '000' . ($modelUser->id + 1) . '-' . $request['persons'] : 'VB' . ($modelUser->id + 1) . '-' . $request['persons'];
            \App\Models\Bookings::create(
                    [
                        'user_id' => $modelUser->id,
                        'BookingID' => $bookingID,
                        'ParentID' => 0,
                        'VisitingCountry' => $request['vistingCountry'],
                        'VisaType' => $request['visaType'],
                    ]
            );
            return view('thankyou')->with(['country' => $country, 'request' => $request]);
            
        } else {
            return view('startvisa')->with(['country' => $country, 'request' => $request]);
        }
        
    }
    
    public function showform(Request $request)
    {
        $booking = Bookings::where("id", $request['visaID'])->first()->toArray();
        $user = \App\Models\UserInfo::where("id", $booking['user_id'])->first()->toArray();
        $bookingId =  $booking['id'];
        $userId =  $user['id'];
        unset($booking['created_at']);
        unset($booking['updated_at']);
        unset($booking['user_id']);
        unset($booking['id']);
        unset($booking['VisitingCountry']);
        unset($booking['ParentID']);
        unset($booking['plan_id']);
        unset($booking['payment_response']);
        unset($booking['verified_at']);
        unset($booking['submission_at']);
        unset($booking['approval_at']);
        unset($booking['status']);
        unset($booking['payment_date']);
        unset($booking['DriveID']);
        unset($booking['paid']);
        unset($booking['amount_paid']);
        unset($booking['assign_date']);
        unset($booking['BookingID']);
        
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['user_id']);
        unset($user['id']);
        
        return view('showform')->with(['user' => $user, 'booking' => $booking, 'bookingId' => $bookingId, 'userId' => $userId]);
    }
}
