<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Google_Client;

class GoogleController extends Controller {

    private $projectName = 'Quickstart';

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
        $client->setScopes(array('https://www.googleapis.com/auth/drive','https://www.googleapis.com/auth/drive.appfolder'));
        $client->setAuthConfig($homeDirectory . 'client_secret.json');
        $client->setDeveloperKey('AIzaSyBmLkJ0sHCn9LSra5yPnXDYBIyoh4aX5nE');
        $client->setRedirectUri($redirect_uri);
        //dd($client);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

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
        if ($client->isAccessTokenExpired()) {
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
        }
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

    public function googledoc() {
        $client = $this->getClient();
        $service = new \Google_Service_Drive($client);
        $docService = new \Google_Service_Docs($client);
        $folderName = 'Nisanth Visa ' . date('d-m-y');
        //$fileName = 'Nisanth_application_data';
        
        
        $foldID = '1XHrdgXsEpu2Se9HpKKRr043NHOy0woHG';    
        $folderMetadata = new \Google_Service_Drive_DriveFile(
                array(
                    'name' => $folderName,
                    'mimeType' => 'application/vnd.google-apps.folder'
                    )
                );
        $folder = $service->files->create($folderMetadata, array('fields' => 'id'));
        
        $files = $this->retrieveAllFiles($service, $foldID);
        $variables = ['{{USERINFO_FirstName}}', '{{USERINFO_Surname}}', '{{USERINFO_PassportNo}}', '{{USERINFO_PassportDOE}}', '{{BOOKINGS_CompanyName}}', '{{BOOKINGS_Designation}}'];
        $values = ['Nisanth', 'Kumar', 'JKLM1234', '2025-10-10', 'VisaBadge Tech Inc', 'CTO'];
        foreach($files as $file) {
            $fileName = 'Nisanth_' . $file->name;
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
                    // Handle error
                    echo '<br />';
                    echo \GuzzleHttp\json_encode($result);
                } else {
                    echo '<br />';
                    echo "Permission ID: %s\n", $result->id;
                }
            }
        } finally {
            $service->getClient()->setUseBatch(false);
        }
        
        //return ['file_name' => $fileName, 'file_id' => $file->id];
        
        //$this->retrieveAllFiles($service, $folder->id);
        //$this->retrieveAllFiles($service, '1GtpHTYzB3N3bZaVgW0CYGwDQx_zzMb9v');
    }
    
    function retrieveAllFiles($service, $folderId) {
        $optParams = array(
            'pageSize' => 999,
            'fields' => 'nextPageToken, files',
            'q' => "'".$folderId."' in parents and mimeType = 'application/vnd.google-apps.document'"
          );
        $results = $service->files->listFiles($optParams);
        
        return $results;
    }
    
    public function googledoc1() {
        // Get the API client and construct the service object.
        $client = $this->getClient();
        $service = new \Google_Service_Docs($client);
        $driveService = new \Google_Service_Drive($client);
        //$title = 'My Document';
        //$document = new \Google_Service_Docs_Document(array(
        //    'title' => $title
        //));
        //$document = $service->documents->create($document);
        // Prints the title of the requested doc:
        // https://docs.google.com/document/d/195j9eDD3ccgjQRttHhJPymLJUCOUjs-jmwTrekvdjFE/edit
        $documentId = '1w6i-roBu1bYxy8qjqmp_1Nc8gZSaIujlXRAWoEs3sSM';
        //$service->getClient()->setUseBatch(true);
        //$doc = $service->documents->get($documentId);
        $driveService->getClient()->setUseBatch(true);
        
        try {
            $batch = $driveService->createBatch();

            $userPermission = new \Google_Service_Drive_Permission(array(
                'type' => 'user',
                'role' => 'writer',
                'emailAddress' => 'nisanthkumar.kn@gmail.com'
            ));
            $request = $driveService->permissions->create($documentId, $userPermission, array('fields' => 'id'));
            $batch->add($request, 'user');
            /*$domainPermission = new Google_Service_Drive_Permission(array(
                'type' => 'domain',
                'role' => 'reader',
                'domain' => 'example.com'
            ));
            $request = $driveService->permissions->create(
                $fileId, $domainPermission, array('fields' => 'id'));
            $batch->add($request, 'domain');*/
            $results = $batch->execute();

            foreach ($results as $result) {
                if ($result instanceof \Google_Service_Exception) {
                    // Handle error
                    dd($result);
                } else {
                    dd("Permission ID: %s\n", $result->id);
                }
            }
        } finally {
            $driveService->getClient()->setUseBatch(false);
        }

        /*$batch = $driveService->createBatch();

        $userPermission = new \Google_Service_Drive_Permission(array(
            'type' => 'user',
            'role' => 'viewer',
            'emailAddress' => 'nisanthkumar.kn@gmail.com'
        ));


        $request = $driveService->permissions->create($documentId, $userPermission, array('fields' => 'id'));

        $batch->add($request, 'user');
        $results = $batch->execute();
        dd($results);
        foreach ($results as $result) {
            if ($result instanceof \Google_Service_Exception) {
                // Handle error
                dd($result);
            } else {
                dd("Permission ID: %s\n", $result->id);
            }
        }*/

        //printf("The document title is: %s\n", $doc->getTitle());

        /*$requests = array();
        $requests[] = new \Google_Service_Docs_Request(array(
            'replaceAllText' => ['containsText' => ['text' => '{{customer}}', 'matchCase' => true], 'replaceText' => 'Nisanth Kumar'],
        ));

        $batchUpdateRequest = new \Google_Service_Docs_BatchUpdateDocumentRequest(array(
            'requests' => $requests
        ));

        $response = $service->documents->batchUpdate($documentId, $batchUpdateRequest);
        dd($response);*/
    }

}
