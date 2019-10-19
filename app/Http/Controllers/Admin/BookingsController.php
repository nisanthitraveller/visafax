<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use \App\Models\Bookings;
use Illuminate\Http\Request;
use \App\Models\Country;
use \App\Models\DocumentType;
use \App\Models\Document;
use App\Models\BookingDocument;

class BookingsController extends Controller
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

    public function get()
    {
        $bookingObj = new Bookings();
        $bookings = $bookingObj->getList();
        return view('admin.bookings')->with(['bookings' => $bookings]);
    }
    
    public function editbooking($bookingId, Request $request)
    {
        $user = Bookings::where("id", $bookingId)->first()->toArray();
        unset($user['created_at']);
        unset($user['updated_at']);
        unset($user['user_id']);
        unset($user['id']);
        unset($user['VisitingCountry']);
        unset($user['ParentID']);
        unset($user['paid']);
        unset($user['payment_response']);
        unset($user['payment_date']);
        unset($user['DriveID']);
        if(!empty($request['VisaType'])) {
            $model = Bookings::findOrFail($bookingId);
            $model->fill($request->toArray());
            $model->save();
            return redirect()->back();
        }
        
        return view('admin.editbooking')->with(['user' => $user]);
    }
    
    public function assigndoc($bookingId)
    {
        $booking = Bookings::where("id", $bookingId)->with('user')->with('country')->with('hotels')->with('child')->first()->toArray();
        $countryDocuments = Document::where('country_id', $booking['VisitingCountry'])->with('documenttype')->select('document_type', 'document_id')->get()->toArray();
        $assignedDocuments = BookingDocument::where('BookingID', $bookingId)->select(['DocumentID'])->get()->toArray();
        $selected = [];
        foreach ($assignedDocuments as $assignedDocument) {
            $selected[] = $assignedDocument['DocumentID'];
        }
        return view('admin.assigndoc')->with(['booking' => $booking, 'countryDocuments' => $countryDocuments, 'selected' => $selected]);
    }
    
    public function viewdocument($bookingId) {
        $booking = Bookings::where("id", $bookingId)->with('user')->with('country')->with('hotels')->with('child')->first()->toArray();
        $countryDocuments = Document::where('country_id', $booking['VisitingCountry'])->with('documenttype')->select('document_type', 'document_id')->get()->toArray();
        $assignedDocuments = BookingDocument::where('BookingID', $bookingId)->select(['DocumentID', 'DriveId'])->get()->toArray();
        $selected = [];
        $driveId = [];
        foreach ($assignedDocuments as $assignedDocument) {
            $selected[] = $assignedDocument['DocumentID'];
            if($assignedDocument['DriveId'] != null) {
                $driveId[$assignedDocument['DriveId']] = $assignedDocument['DocumentID'];
            }
        }
        
        return view('admin.viewdoc')->with(['booking' => $booking, 'countryDocuments' => $countryDocuments, 'selected' => $selected, 'driveId' => $driveId]);
    }
}
