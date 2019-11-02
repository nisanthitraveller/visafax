<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;
use App\User;
use App\Models\Visa;
use Mail;

class GoogleController extends Controller {

    private $projectName = 'VisaBadge';

    /**
     * Returns an authorized API client.
     * @return Google_Client the authorized client object
     */
    public function getClient() {
        
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
        if (file_exists($this->tokenFile)) {
            $accessToken = json_decode(file_get_contents($this->tokenFile), true);
        } else {
            // Request authorization from the user.
            $authUrl = $client->createAuthUrl();
            header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));

            if (null !== (request('code'))) {
                $authCode = request('code');
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
                if (!file_exists(dirname($this->tokenFile))) {
                    mkdir(dirname($this->tokenFile), 0700, true);
                }

                file_put_contents($this->tokenFile, json_encode($accessToken));
            } else {
                exit('No code found');
            }
        }
        $client->setAccessToken($accessToken);

        // Refresh the token if it's expired.
        /*if ($client->isAccessTokenExpired()) {
            // save refresh token to some variable
            $refreshTokenSaved = $client->getRefreshToken();

            // update access token
            $client->fetchAccessTokenWithRefreshToken($refreshTokenSaved);

            // pass access token to some variable
            $accessTokenUpdated = $client->getAccessToken();

            // append refresh token
            $accessTokenUpdated['refresh_token'] = $refreshTokenSaved;

            //Set the new acces token
            $accessToken = $refreshTokenSaved;
            $client->setAccessToken($accessToken);

            // save to file
            file_put_contents($this->tokenFile, json_encode($accessTokenUpdated));
        }*/
        return $client;
    }

    /**
     * Expands the home directory alias '~' to the full path.
     * @param string $path the path to expand.
     * @return string the expanded path.
     */
    function expandHomeDirectory($path) {
        $homeDirectory = env('HOME');
        if (empty($homeDirectory)) {
            $homeDirectory = env('HOMEDRIVE') . env('DOCPATH');
        }
        return str_replace('~', realpath($homeDirectory), $path);
    }
    
    public function createRootFolder($name, $folder_root) {
        $fileMetadata = new Google_Service_Drive_DriveFile(array(
            'name' => $name,
            "parents" => [$folder_root],
            'mimeType' => 'application/vnd.google-apps.folder'));
             $file = $this->service->files->create($fileMetadata, array(
            'fields' => 'id'));
        return $file;
    }

    public function googledoc($bookingId) {
        
        $visaObj = new Visa();
        $client = $this->getClient();
        $service = new \Google_Service_Drive($client);
        $docService = new \Google_Service_Docs($client);
        
        $visaDetails = $visaObj->getVisa($bookingId);
        
        foreach ($visaDetails as $visaDetail) {
            $folderName = $visaDetail->BookingID;

            $foldID = $visaDetail->folderID;    
            $folderMetadata = new \Google_Service_Drive_DriveFile(
                    array(
                        'name' => $folderName,
                        'mimeType' => 'application/vnd.google-apps.folder'
                        )
                    );
            $folder = $service->files->create($folderMetadata, array('fields' => 'id'));

            $files = $this->retrieveAllFiles($service, $foldID);
            $variables = ['{{USERINFO_FirstName}}', '{{USERINFO_Surname}}', '{{BOOKINGS_VisitingCountry}}', '{{USERINFO_CurrentNationality}}', '{{USERINFO_PhoneNo}}', '{{USERINFO_EmailID}}', '{{USERINFO_CityOfResidence}}'];
            
            $values = [
                $visaDetail->FirstName, 
                $visaDetail->Surname, 
                $visaDetail->countryName, 
                $visaDetail->CurrentNationality,
                $visaDetail->PhoneNo,
                $visaDetail->EmailID,
                $visaDetail->CityOfResidence
            ];
            foreach($files as $file) {
                $visaObj->updateDriveID($visaDetail->BookingID, $folder->id);
                $fileName = $file->name . ' ' . $visaDetail->FirstName . ' ' . $visaDetail->Surname . ' ' . $visaDetail->BookingID;
                $copy = new \Google_Service_Drive_DriveFile(array(
                    'name' => $fileName,
                    'parents' => [$folder->id]
                ));
                $copy->setParents([$folder->id]);
                $driveResponse = $service->files->copy($file->id, $copy);
                $documentCopyId = $driveResponse->id;


                $requests = array();
                foreach($variables as $key => $variable) {
                    $requests[] = new \Google_Service_Docs_Request(array(
                        'replaceAllText' => ['containsText' => ['text' => $variable, 'matchCase' => true], 'replaceText' => $values[$key]],
                    ));
                }

                $batchUpdateRequest = new \Google_Service_Docs_BatchUpdateDocumentRequest(array(
                    'requests' => $requests
                ));

                $docService->documents->batchUpdate($documentCopyId, $batchUpdateRequest);

            }

            $service->getClient()->setUseBatch(true);

            try {
                $batch = $service->createBatch();
                $emails = ['nisanthkumar.kn@gmail.com', 'shiju.radhakrishnan@itraveller.com', 'binse.abraham@itraveller.com'];
                foreach($emails as $key => $email) {
                    $userPermission = new \Google_Service_Drive_Permission(
                            array(
                                'type' => 'user',
                                'role' => 'writer',
                                'emailAddress' => $email
                            )
                        );
                    $request = $service->permissions->create($folder->id, $userPermission, array('fields' => 'id'));
                    $batch->add($request, 'user' . ($key + 1));
                }
                $results = $batch->execute();

                foreach ($results as $result) {
                    if ($result instanceof \Google_Service_Exception) {
                    } else {
                        //echo '<br />';
                        //echo "Permission ID: %s\n", $result->id;
                    }
                }
            } finally {
                $service->getClient()->setUseBatch(false);
            }
        }
    }
    
    function retrieveAllFiles($service, $folderId) {
        $optParams = array(
            'pageSize' => 999,
            'fields' => 'nextPageToken, files',
            'q' => "'".$folderId."' in parents and mimeType = 'application/vnd.google-apps.document' or mimeType = 'application/pdf'"
          );
        $results = $service->files->listFiles($optParams);
        
        return $results;
    }
    
    public function tokensignin(Request $input) {
        
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        
        $visaObj = new Visa();
        
        $homeDirectory = env('HOMEDRIVE');
        $tokenFile = $homeDirectory . 'token.json';
        //if (!file_exists($tokenFile)) {
            //mkdir(dirname($tokenFile), 0700, true);
            file_put_contents($tokenFile, json_encode($input['accsTkn']));
        //}

        
        $client = new Google_Client();  // Specify the CLIENT_ID of the app that accesses the backend
        $client->setAuthConfig($homeDirectory . 'client_secret.json');
        $payload = $client->verifyIdToken($input['idtoken']);
        
        
        
        $return = [];
        //$return['input'] = $input;
        if ($payload) {
            $return['status'] = true;
            $userId = $payload['sub'];
            
            $finduser = User::where('provider_id', $userId)->first();
            
            if ($finduser) {
                $return['redirect'] = true;
                $finduser->first_name = $payload['given_name'];
                $finduser->last_name = $payload['family_name'];
                $finduser->save();
                
                $input['userId'] = $finduser->id;
                $auth = auth()->loginUsingId($finduser->id, true);
                if($input['vistingCountry'] != null) {
                    $parentId = $visaObj->createVisa($input);
                    $return['parentId'] = $parentId;
                } else {
                    $return['parentId'] = 0;
                }
                //$this->googledoc($parentId);
                
                
            } else {
                $return['redirect'] = false;
                // Insert user data
                $newUser = User::create([
                    'name' => $payload['name'],
                    'first_name' => $payload['given_name'],
                    'last_name' => $payload['family_name'],
                    'email' => $payload['email'],
                    'provider' => 'google',
                    'provider_id' => $payload['sub'],
                    'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                    'avatar' => $payload['picture'],
                ]);
                // Mobile bypass
                $input['userId'] = $newUser->id;
                $parentId = $visaObj->createVisa($input);
                
                // Send mail with User details
                Mail::send('mail.user-details', ['payload' => $payload], function($message) use($payload) {
                    $message->from('operations@visabadge.com', 'Operations VisaBadge');
                    $message->to('operations@visabadge.com', 'VB Operations')
                            ->cc('shiju.radhakrishnan@visabadge.com')
                            ->cc('shiju.radhakrishnan@itraveller.com')
                            ->bcc('nisanth.kumar@itraveller.com')
                            ->subject('VisaBadge: New User ' . $payload['name']);
                });
                
                $auth = auth()->login($newUser, true);
                
            }
            
        } else {
            $return['status'] = false;
        }
        
        return json_encode($return);
    }
    
    public function updatemobile(Request $request) {
        $visaObj = new Visa();
        $user = auth()->user();
        $user->phone = $request['mobile'];
        $user->save();
        
        Mail::send('mail.user-details-phone', ['payload' => $user], function($message) use($user) {
                    $message->from('operations@visabadge.com', 'Operations VisaBadge');
                    $message->to('operations@visabadge.com', 'VB Operations')
                            ->cc('shiju.radhakrishnan@visabadge.com')
                            ->cc('shiju.radhakrishnan@itraveller.com')
                            ->bcc('nisanth.kumar@itraveller.com')
                            ->subject('VisaBadge: New User with phone ' . $user->name);
                });
        
        $request['userId'] = $user->id;
        $parentId = $visaObj->createVisa($request);
        
        //$this->googledoc($parentId);
        
        $return['status'] = false;
        $return['parentId'] = $parentId;
        
        return json_encode($return);
    }
    
    public function createvisa(Request $input) {
        $visaObj = new Visa();
        $user = auth()->user();
        
        $input['userId'] = $user->id;
        $parentId = $visaObj->createVisa($input);
        
        //$this->googledoc($parentId);
        
        $return['status'] = true;
        $return['parentId'] = $parentId;
        
        return json_encode($return);
    }
    
    public function submitdoc(Request $input) {
        $visaObj = new Visa();
        $countryObj = new \App\Models\Country();
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
        
        $homeDirectory = env('HOMEDRIVE');
        $tokenFile = $homeDirectory . 'token.json';
        file_put_contents($tokenFile, json_encode($input['accsTkn']));

        
        $client = $this->getClient();
        $client->setAuthConfig($homeDirectory . 'client_secret.json');
        $client->verifyIdToken($input['idtoken']);
        
        $service = new \Google_Service_Drive($client);
        $docService = new \Google_Service_Docs($client);
        $booking = \App\Models\Bookings::where("id", $input['bookingId'])->with('user')->with('country')->with('hotels')->with('child')->first()->toArray();
        $countryDocuments = \App\Models\Document::where('country_id', $booking['VisitingCountry'])->with('documenttype')->select('document_type', 'document_id')->get()->toArray();
        $documentTypeId = $documentTypeName = $driveId = [];
        foreach($countryDocuments as $countryDocument) {
            $documentTypeId[] = $countryDocument['document_type'];
            $documentTypeName[] = $countryDocument['documenttype']['type'];
            $driveId[] = $countryDocument['document_id'];
        }
        if($booking['DriveID'] == null) {
            $folderName = $booking['BookingID'];
            $folderMetadata = new \Google_Service_Drive_DriveFile(
                array(
                    'name' => $folderName,
                    'mimeType' => 'application/vnd.google-apps.folder'
                    )
                );
            $folder = $service->files->create($folderMetadata, array('fields' => 'id'));
            $bookingDriveID = $folder->id;
            $visaObj->updateDriveIDBooking($input['bookingId'], $bookingDriveID);
        } else {
            $bookingDriveID = $booking['DriveID'];
        }
        $variables = [
            '{{Current_Date}}' => date('d.m.Y'),
            '{{USERINFO_FirstName}}' => $booking['user']['FirstName'], 
            '{{USERINFO_Surname}}' => $booking['user']['Surname'],
            '{{USERINFO_PassportNo}}' => $booking['user']['PassportNo'],
            '{{USERINFO_PassportDOE}}' => date('d M Y', strtotime($booking['user']['PassportDOE'])),
            '{{USERINFO_Address}}' => $booking['user']['Address'],
            '{{USERINFO_CurrentNationality}}' => $booking['user']['CurrentNationality'], 
            '{{USERINFO_PhoneNo}}' => $booking['user']['PhoneNo'], 
            '{{USERINFO_EmailID}}' => $booking['user']['EmailID'], 
            '{{USERINFO_DOB}}' => date('d M Y', strtotime($booking['user']['DOB'])), 
            '{{USERINFO_CityOfResidence}}' => $booking['user']['CityOfResidence'],
            
            '{{BOOKINGS_ConsulateAddress}}' => $booking['ConsulateAddress'],
            '{{BOOKINGS_VisitingCountry}}' => $booking['VisitingCountry'],
            '{{BOOKINGS_CompanyName}}' => $booking['CompanyName'],
            '{{BOOKINGS_Designation}}' => $booking['Designation'],
            '{{BOOKINGS_EmployeeID}}' => $booking['EmployeeID'],
            '{{BOOKINGS_CompanyLocation}}' => $booking['CompanyLocation'],
            '{{BOOKINGS_JoiningDate}}' => $booking['JoiningDate'],
            '{{BOOKINGS_VisitingOfficeAddress}}' => $booking['VisitingOfficeAddress'],
            '{{BOOKINGS_CompanyPhone}}' => $booking['CompanyPhone'],
            '{{BOOKINGS_VisitingCompanyName}}' => $booking['VisitingCompanyName'],
            '{{BOOKINGS_AuthorisedSignatoryName}}' => $booking['AuthorisedSignatoryName'],
            '{{BOOKINGS_AuthorisedSignatoryDesignation}}' => $booking['AuthorisedSignatoryDesignation'],
            '{{BOOKINGS_VisitingCompanyAuthorisedPerson}}' => $booking['VisitingCompanyAuthorisedPerson'],
            '{{BOOKINGS_VisitingCompanyAuthorisedDesignation}}' => $booking['VisitingCompanyAuthorisedDesignation'],
            '{{BOOKINGS_SchoolName}}' => $booking['SchoolName'],
            '{{BOOKINGS_Class}}' => $booking['Class'],
            '{{BOOKINGS_StudentID}}' => $booking['StudentID'],
            '{{BOOKINGS_SchoolAuthorisedDesignation}}' => $booking['SchoolAuthorisedDesignation'],
            '{{BOOKINGS_SchoolAuthorisedName}}' => $booking['SchoolAuthorisedName'],
            '{{BOOKINGS_SchoolAuthorisedPhone}}' => $booking['SchoolAuthorisedPhone'],
            '{{BOOKINGS_VisitingCountry}}' => $booking['country']['countryName']
            
            ];
        $str = null;
        if(!empty($booking['child'])) {
            foreach($booking['child'] as $child) {
                $user = \App\Models\UserInfo::where("id", $child['user_id'])->first()->toArray();
                $str .= $user['FirstName']. ' ' . $user['Surname'] . ', holding passport issued by Republic of India, having passport number ' . $user['PassportNo'];
            }
        }
        
        $strHotel = null;
        if(!empty($booking['hotels'])) {
            $strHotel .= 'During our stay, we will be staying at the following locations. ' . "\n";
            foreach($booking['hotels'] as $hotel) {
                $strHotel .= 'From: ' . date('d M Y', strtotime($hotel['DateFrom']))  . "\n";
                $strHotel .= 'To: ' . date('d M Y', strtotime($hotel['DateTo']))  . "\n";
                $strHotel .= 'Place: ' . $hotel['Place'] . "\n";
                $strHotel .= 'Hotel Name: ' . $hotel['HotelName'] . "\n";
                $strHotel .= 'Address: ' . $hotel['HotelAddress'] . "\n";
                $strHotel .= 'Phone: ' . $hotel['Phone'] . '\n';

            }
            $hotelCountry = \App\Models\Country::where("id", $booking['hotels'][0]['Country'])->first();
            $variables['{{HOTEL_From}}'] = date('d M Y', strtotime($booking['hotels'][0]['DateFrom']));
            $variables['{{HOTEL_To}}'] = date('d M Y', strtotime($booking['hotels'][0]['DateTo']));
            $variables['{{HOTEL_HotelName}}'] = $booking['hotels'][0]['HotelName'];
            $variables['{{HOTEL_Address}}'] = $booking['hotels'][0]['HotelAddress'];
            $variables['{{HOTEL_Country}}'] = $hotelCountry['countryName'];
            $variables['{{HOTEL_Place}}'] = $booking['hotels'][0]['Place'];
        }
        
        $variables['{{HOTEL_BOOKINGS}}'] = $strHotel;
        $variables['{{USERINFO_OtherTravellers}}'] = $str;
        
        
        
        foreach($input['document_type'] as $documentType) {
            $key = array_search($documentType, $documentTypeId);
            if($key !== false) {
                if($driveId[$key] != null) {
                    $fileName = $documentTypeName[$key] . ' ' . $booking['user']['FirstName'] . ' ' . $booking['user']['Surname'] . ' ' . $booking['BookingID'];
                    $copy = new \Google_Service_Drive_DriveFile(array(
                        'name' => $fileName,
                        'parents' => [$bookingDriveID]
                    ));
                    $copy->setParents([$bookingDriveID]);
                    $driveResponse = $service->files->copy($driveId[$key], $copy);
                    $documentCopyId = $driveResponse->id;
                    
                    //Replacing texts
                    $requests = array();
                    foreach($variables as $variable => $value) {
                        $requests[] = new \Google_Service_Docs_Request(array(
                            'replaceAllText' => ['containsText' => ['text' => $variable, 'matchCase' => false], 'replaceText' => $value],
                        ));
                    }

                    $batchUpdateRequest = new \Google_Service_Docs_BatchUpdateDocumentRequest(array(
                        'requests' => $requests
                    ));
                    if($documentCopyId != null) {
                        $docService->documents->batchUpdate($documentCopyId, $batchUpdateRequest);
                    }
                    
                } else {
                    $documentCopyId = null;
                }
                $visaObj->updateDriveID($input['bookingId'], $documentCopyId, $documentType);
                
            }
        }
        
        $service->getClient()->setUseBatch(true);

        try {
            $batch = $service->createBatch();
            //$emails = ['nisanthkumar.kn@gmail.com', 'shiju.radhakrishnan@itraveller.com', 'binse.abraham@itraveller.com'];
            //foreach($emails as $key2 => $email) {
            $userPermission = new \Google_Service_Drive_Permission(
                    array(
                        'type' => 'anyone',
                        'role' => 'writer',
                    )
                );
            $request = $service->permissions->create($bookingDriveID, $userPermission, array('fields' => 'id'));
            $batch->add($request, 'user');
            //}
            $results = $batch->execute();

            foreach ($results as $result) {
                if ($result instanceof \Google_Service_Exception) {
                } else {
                    //echo '<br />';
                    //echo "Permission ID: %s\n", $result->id;
                }
            }
        } finally {
            $service->getClient()->setUseBatch(false);
        }
        Mail::send('mail.mail-assign', ['booking' => $booking], function($message) use($booking) {
            $message->from('operations@visabadge.com', 'Operations VisaBadge');
            $message->to($booking['user']['EmailID'], $booking['user']['FirstName'] .' ' . $booking['user']['Surname'])
                    ->cc('operations@visabadge.com')
                    ->bcc(['shiju.radhakrishnan@itraveller.com', 'nisanth.kumar@itraveller.com'])
                    ->subject('VisaBadge: Document generated for Booking ID ' . $booking['BookingID']);
        });
        return json_encode(['success' => true]);
    }

}
