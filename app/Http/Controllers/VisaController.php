<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Visa;
use Google_Client;

class VisaController extends Controller
{
    private $projectName = 'VisaBadge';
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
        $user = auth()->user();
        
        $allVisa = $visaObj->getAllMyVisa($user->id);
        $allVisa = json_decode(json_encode($allVisa), True);
        $bookingId = $allVisa[0]['id'];
        if($request['bookingID']) {
            $bookingId = $request['bookingID'];
        }
        
        $client = $this->getGoogleClient();
        $service = new \Google_Service_Drive($client);
        
        $visaDetails = $visaObj->getVisa($bookingId);
        
        if($visaDetails[0]->user_id != $user->id) {
            die('No booking found!');
        }
        
        foreach ($visaDetails as $key => $visaDetail) {
            $foldID = $visaDetail->folderID;    

            $files[$key] = $this->retrieveDriveFiles($service, $foldID);
        }
        dd($files);
        return view('dashboard')->with(['allVisa' => $allVisa, 'files' => $files]);
    }
    
    public function payusubmit(Request $request) {
        $view = view('PayUSubmitPayment')->with(array('data' => $request));
        $contents = $view->render();
        return $contents;
    }
    
    public function getGoogleClient() {
        
        $redirect_uri = \Illuminate\Support\Facades\URL::current();
        define('STDIN', fopen('php://stdin', 'r'));
        $homeDirectory = env('HOMEDRIVE');
        $this->tokenFile = $homeDirectory . 'token.json';
        $client = new Google_Client();
        $client->setApplicationName($this->projectName);
        $client->setScopes(array('profile', 'email', 'https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.appfolder'));
        $client->setAuthConfig($homeDirectory . 'client_secret.json');
        $client->setDeveloperKey('AIzaSyBmLkJ0sHCn9LSra5yPnXDYBIyoh4aX5nE');
        $client->setRedirectUri($redirect_uri);
        //dd($client);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');
        //$client->setAccessToken($token);
        //dd($client);
        // Load previously authorized credentials from a file.
        //if (file_exists($this->tokenFile) && $client->getRefreshToken() != null) {
        //    $accessToken = json_decode(file_get_contents($this->tokenFile), true);
        //} else {
            $oldaccessToken = json_decode(file_get_contents($this->tokenFile), true);
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

            if (null !== (request('code'))) {
                $authCode = request('code');
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                //header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
                $accessToken = array_merge($oldaccessToken, $accessToken);
                    file_put_contents($this->tokenFile, json_encode($accessToken));
                } else {
                    exit('No code found');
                }
        //}
        
        /*if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $newAccessToken = $client->getAccessToken();
            $accessToken = array_merge($accessToken, $newAccessToken);
            file_put_contents($this->tokenFile, json_encode($accessToken));
        }*/
        
        $client->setAccessToken($accessToken);
        return $client;
    }
    
    function retrieveDriveFiles($service, $folderId) {
        $optParams = array(
            'pageSize' => 999,
            'fields' => 'nextPageToken, files',
            'q' => "'".$folderId."' in parents and mimeType = 'application/vnd.google-apps.document'"
          );
        $results = $service->files->listFiles($optParams);
        
        return $results;
    }
}
