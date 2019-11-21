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
                    'Bucket' => 'textract-console-us-east-1-99c77c15-6a14-4050-ad5a-3d3366db6002',
                    'Name' => $file
                ],
            ],
            'FeatureTypes' => ['TABLES', 'FORMS'], // REQUIRED
        ]);
        $result = $client->analyzeDocument([
            'Document' => [ // REQUIRED
                'S3Object' => [
                    'Bucket' => 'textract-console-us-east-1-99c77c15-6a14-4050-ad5a-3d3366db6002',
                    'Name' => $file
                ],
            ],
            'FeatureTypes' => ['FORMS'], // REQUIRED
        ]);
        $data = $result->toArray();*/
        $result2 = $client->getDocumentAnalysis([
            'JobId' => '37413011ebb5ad8839745a89f2a0c337263fc0a6eb8b2bc7e5a7ee6d2231ff2b'
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
                    'Key'        => $file->getClientOriginalName(),
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
       $file = 'uploads' . '/0VB00021-1-Swissvisa-application_For_Visa_080515(2).pdf';
       $pdf = new Pdf($file);
       //\Gufy\PdfToHtml\Config::set('pdftohtml.bin', '/usr/bin/pdftohtml');

        // change pdfinfo bin location
        //\Gufy\PdfToHtml\Config::set('pdfinfo.bin', '/usr/bin/pdfinfo');
       $dom = $pdf->html();
       
       dd($dom);
        $url = 'https://' . env('AWS_BUCKET') . '.s3.amazonaws.com/';
        $s3 = AWS::createClient('s3');
        $images = $s3->listObjects(['Bucket' => 'visabadge-bucket'])->toArray();
        return view('bucket-images')->with(array('images' => $images['Contents'], 'url' => $url));
   }
}
