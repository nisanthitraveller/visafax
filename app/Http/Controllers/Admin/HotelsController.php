<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\User;
//use Illuminate\Support\Facades\Auth;
use \App\Models\Bookings;
use \App\Models\Hotels;
use Illuminate\Http\Request;
use \App\Models\Country;

class HotelsController extends Controller
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

    public function hotels($bookingId)
    {
        $hotels = Hotels::where("BookingID", $bookingId)->with('country')->with('booking')->get()->toArray();
        return view('admin.hotels')->with(['hotels' => $hotels, 'bookingId' => $bookingId]);
    }
    
    public function addhotel($bookingId, Request $request)
    {
        $countries = Country::all();
        if(!empty($request['BookingID'])) {
            $hotelsObj = new Hotels();
            $hotelsObj->fill($request->toArray());
            $hotelsObj->save();
            return redirect('/bo/hotels/' . $bookingId)->with('status', 'Created!');
        }
        
        return view('admin.addhotel')->with(['bookingId' => $bookingId, 'countries' => $countries]);
    }
    
    public function edithotel($bookingId, Request $request)
    {
        $hotel = Hotels::where("id", $bookingId)->first()->toArray();
        $countries = Country::all();
        unset($hotel['created_at']);
        unset($hotel['updated_at']);
        unset($hotel['id']);
        unset($hotel['Country']);
        unset($hotel['BookingID']);
        if(!empty($request['HotelName'])) {
            $model = Hotels::findOrFail($bookingId);
            $model->fill($request->toArray());
            $model->save();
            return redirect()->back();
        }
        
        return view('admin.edithotel')->with(['hotel' => $hotel, 'countries' => $countries]);
    }
    
    public function assigndoc($bookingId)
    {
        $booking = Bookings::where("id", $bookingId)->with('user')->with('country')->with('child')->first()->toArray();
        $countryDocuments = Document::where('country_id', $booking['VisitingCountry'])->with('documenttype')->select('document_type', 'document_id')->get()->toArray();
        $assignedDocuments = BookingDocument::where('BookingID', $bookingId)->select(['DocumentID'])->get()->toArray();
        $selected = [];
        foreach ($assignedDocuments as $assignedDocument) {
            $selected[] = $assignedDocument['DocumentID'];
        }
        return view('admin.assigndoc')->with(['booking' => $booking, 'countryDocuments' => $countryDocuments, 'selected' => $selected]);
    }
    
    public function assigndocsubmit(Request $request)
    {
        $booking = Bookings::where("id", $request['bookingId'])->first()->toArray();
        $countryDocuments = Document::where('country_id', $booking['VisitingCountry'])->with('documenttype')->select('document_type', 'document_id')->get()->toArray();
        
        return view('admin.assigndoc')->with(['booking' => $booking, 'countryDocuments' => $countryDocuments]);
    }
}
