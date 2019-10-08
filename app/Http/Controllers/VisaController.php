<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class VisaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function step1($bookingId)
    {
        $bookingId = str_replace('-', ' ', $bookingId);
        $country = Country::where("countryName", $visaUrl)
                ->first()->toArray();
        return view('applyvisa')->with(['country' => $country]);
    }
}
