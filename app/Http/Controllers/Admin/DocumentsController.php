<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\DocumentType;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    protected $user;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/bo/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function documenttypes()
    {
        $documentTypeObj = new DocumentType();
        $documentTypes = $documentTypeObj->getList();
        return view('admin.documents')->with(['documentTypes' => $documentTypes]);
    }
    
    public function editdocumenttype($Id, Request $request)
    {
        $documentType = DocumentType::where("id", $Id)->first()->toArray();
        unset($documentType['id']);
        unset($documentType['created_at']);
        unset($documentType['updated_at']);
        if(!empty($request['type'])) {
            $model = DocumentType::findOrFail($Id);
            $model->fill($request->toArray());
            $model->save();
            return redirect('/bo/documenttypes')->with('status', 'Document updated!');
        }
        
        return view('admin.editdocument')->with(['documentType' => $documentType]);
    }
    
    public function adddocumenttype(Request $request)
    {
        $documentTypeObj = new DocumentType();
        if(!empty($request['type'])) {
            $documentTypeObj->type = request('type');
            $documentTypeObj->save();
            return redirect('/bo/documenttypes')->with('status', 'Created!');
        }
        
        return view('admin.adddocument');
    }
}
