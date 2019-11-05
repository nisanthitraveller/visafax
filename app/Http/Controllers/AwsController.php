<?php

namespace App\Http\Controllers;

use AWS;

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
        dd($s3->listObject(['Bucket' => 'arn:aws:s3:::textract-console-us-east-1-99c77c15-6a14-4050-ad5a-3d3366db6002']));
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
