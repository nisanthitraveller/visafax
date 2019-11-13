<?php

namespace App\Http\Controllers;

use AWS;
use Aws\Textract\TextractClient;

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
    
    public function bucket()
    {
        
        $s3 = AWS::createClient('s3');
        $client = new TextractClient([
            'region' => env('AWS_DEFAULT_REGION'),
            'version' => 'latest',
            'aws_access_key_id' => env('AWS_ACCESS_KEY_ID'),
            'aws_secret_access_key' => env('AWS_SECRET_ACCESS_KEY'),
        ]);
        $files = $s3->listObjects(['Bucket' => 'visabadge-bucket']);
        //dd($files);
        //foreach($files->Contents as $file) {
            
        //}
        $result = $client->analyzeDocument([
            'Document' => [ // REQUIRED
                'S3Object' => [
                    'Bucket' => 'visabadge-bucket',
                    'Name' => 'test.png'
                ],
            ],
            'FeatureTypes' => ['FORMS'], // REQUIRED
        ]);
        dd($result);
    }
    public function store(Request $request)
       {
           $this->validate($request, [
               'image' => 'required|image|max:2048'
           ]);
           if ($request->hasFile('image')) {
               $file = $request->file('image');
               $name = time() . $file->getClientOriginalName();
           $filePath = 'images/' . $name;
           Storage::disk('s3')->put($filePath, file_get_contents($file));
       }
       return back()->withSuccess('Image uploaded successfully');
   }
   public function destroy($image)
   {
       Storage::disk('s3')->delete('images/' . $image);
       return back()->withSuccess('Image was deleted successfully');
   }
}
