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
    
    public function payment($bookingId)
    {
        return view('payment')->with(['bookingId' => $bookingId]);
    }
    
    public function step1($bookingId)
    {
        return view('step1')->with(['bookingId' => $bookingId]);
    }
    
    public function step2($bookingId)
    {
        return view('step1')->with(['bookingId' => $bookingId]);
    }
}
