<?php

namespace App\Http\Controllers;

use AWS;
use Aws\Textract\TextractClient;
use Storage;
use Illuminate\Http\Request;
use Gufy\PdfToHtml\Pdf;
class AwsController extends Controller
{
    //private $projectName = 'VisaBadge';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function s3bucket()
    {
        $s3 = AWS::createClient('s3');
        $s3->putObject(array(
            'Bucket'     => 'YOUR_BUCKET',
            'Key'        => 'YOUR_OBJECT_KEY',
            'SourceFile' => '/the/path/to/the/file/you/are/uploading.ext',
        ));
    }
    
    public function bucket(Request $request)
    {
        $file = isset($request['file']) ? $request['file'] : 'passport1.jpeg';
        //$s3 = AWS::createClient('s3');
        $client = new TextractClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'aws_access_key_id' => env('AWS_ACCESS_KEY_ID'),
            'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        ]);
        //$files = $s3->listObjects(['Bucket' => 'visabadge-bucket']);
        //dd($files);
        //foreach($files->Contents as $file) {
            
        //}
        /*$result = $client->startDocumentAnalysis([
            'DocumentLocation' => [ // REQUIRED
                'S3Object' => [
                    'Bucket' => 'visabadge-bucket',
                    'Name' => $file
                ],
            ],
            'FeatureTypes' => ['TABLES', 'FORMS'], // REQUIRED
        ]);
        $data = $result->toArray();
        dd($data);*/
        $result2 = $client->getDocumentAnalysis([
            //'JobId' => $data['JobId']
            'JobId' => '9f9dd33f63d271c582d5399d28d7c9cdbb20036c5f1aa951b183837ad56948d0'
        ]);
        echo '<pre>';
        //print_r($data);
        dd($result2->toArray());
        $url = 'https://' . env('AWS_BUCKET') . '.s3.amazonaws.com/';
        echo '<img style="width:30%" src="' . $url . $file .'" />';
        $cnt = 1;
        foreach($data['Blocks'] as $block) {
            if($block['BlockType'] == 'LINE' && $block['Text'] != '') {
                echo '<br>' . $cnt . ' ' . $block['Text'];
                $cnt++;
            }
        }
    }
    public function store(Request $request)
       {
           $this->validate($request, [
               'image' => 'required|max:2048'
           ]);
           if ($request->hasFile('image')) {
               $file = $request->file('image');
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
                    'Key'        => time() . $file->getClientOriginalName(),
                    'SourceFile' => $file->getPathname(),
                    'ACL'    => 'public-read'
                ));
            }
       return back()->withSuccess('Image uploaded successfully');
   }
   public function destroy($image)
   {
       Storage::disk('s3')->delete('images/' . $image);
       return back()->withSuccess('Image was deleted successfully');
   }
   
   public function image()
   {
        $url = 'https://' . env('AWS_BUCKET') . '.s3.amazonaws.com/';
        $s3 = AWS::createClient('s3');
        $images = $s3->listObjects(['Bucket' => 'visabadge-bucket'])->toArray();
        return view('bucket-images')->with(array('images' => $images['Contents'], 'url' => $url));
   }
   
   public function readdoc(Request $request)
   {
        $client = new TextractClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'aws_access_key_id' => env('AWS_ACCESS_KEY_ID'),
            'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        ]);
        
        $result2 = $client->getDocumentAnalysis([
            'JobId' => $request['JobId']
            //'JobId' => '9f9dd33f63d271c582d5399d28d7c9cdbb20036c5f1aa951b183837ad56948d0'
        ]);
        
        $keyArray = [
            'Passport No' => ['count' => [4], 'db' => 'PassportNo'],
            'Surname' => ['count' => [2], 'db' => 'Surname'],
            'Given Name' => ['count' => [1], 'db' => 'FirstName'],
            'Nationality' => ['count' => [3], 'db' => 'CurrentNationality'],
            'Sex' => ['count' => [3], 'db' => 'Sex'],
            'Date of Birth' => ['count' => [3], 'db' => 'DOB'],
            'Place of Birth' => ['count' => [1], 'db' => 'PlaceOfBirth'],
            'Place of Issue' => ['count' => [1], 'db' => ''],
            'Date of Issue' => ['count' => [2], 'db' => 'PassportDOI'],
            'Date of Expiry' => ['count' => [2], 'db' => 'PassportDOE'],
            'Name of Father' => ['count' => [1], 'db' => ''],
            'Name of Mother' => ['count' => [1], 'db' => ''],
            'Name of Spouse' => ['count' => [1], 'db' => ''],
            'Address' => ['count' => [1, 2, 3], 'db' => 'Address'],
            'OId Passport No' => ['count' => [1], 'db' => ''],
            
        ];
        
        $data = $result2->toArray();
        $readData = [];
        $rr = [];
        if($data['JobStatus'] == 'SUCCEEDED') {
            if(!empty($data['Blocks'])) {
                $cnt = 0;
                foreach($data['Blocks'] as $block) {
                    if($block['BlockType'] == 'LINE' && $block['Text'] != '') {
                        $readData[$cnt] = $block['Text'];
                        $cnt++;
                    }
                }
            }
            
            //dd($readData);
            foreach($readData as $k => $rd) {
                foreach ($keyArray as $key => $k1) {
                    foreach ($k1['count'] as $key1) {
                        if (strpos($rd, $key) !== false) {
                            if (is_numeric($key1) && is_numeric($k)) {
                                if(!empty($k1['db'])) {
                                    $rr[$k1['db']][] = $readData[$k + $key1];
                                }
                            } else {
                                echo '<br/>' . $key1;
                            }

                            //echo '<br/>' . $k1;
                            //$rr[$k1] = $readData[$k + $key1];
                        }
                    }
                }
            }
            $booking = \App\Models\Bookings::where("id", $request['visaID'])->first()->toArray();
            $tt = [];
            foreach ($rr as $k => $dt) {
                if($k == 'Address') {
                    //dd($dt);
                    $v = implode(',', $dt);
                } else if($k == 'PassportDOI' || $k == 'PassportDOE' || $k == 'DOB') {
                    //dd($dt);
                    $v = $dt[0];
                    $v[2] = '/';
                    $v[5] = '/';
                    $v = implode("-", array_reverse(explode("/", $v)));
                } else {
                    $v = $dt[0];
                }
                $tt[$k] = $v;
            }
            //dd($tt);
            $model = \App\Models\UserInfo::findOrFail($booking['user_id']);
            $model->fill($tt);
            $model->save();
            
            return response()->json([
                'message'   => 'Saved Successfully',
                'class_name'  => 'alert-success',
                'status' => 'success'
            ]);
            
        } else {
            return response()->json([
                'message'   => 'Saved Successfully',
                'class_name'  => 'alert-danger',
                'status' => 'failed'
            ]);
        }
        
        //$keys = array_keys($readData, 'ua fif/Date of Issue');
        
        
   }
}
