<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function welcome()
    {
        $blogObj = new \App\Models\Blog();
        $countryObj = new Country();
        
        $feeds = $blogObj->getFeeds();
        $countries = $countryObj->all()->toArray();
        $new_array = array();
        foreach($countries as $item) {
          $new_array[str_replace(' ', '-', $item['continentName'])][] = $item;
        }
        return view('welcome')->with(['feeds' => $feeds, 'countries' => $new_array]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = Country::select("countryName as name", "id")
                ->where("countryName","LIKE","%{$request->input('query')}%")
                ->get();
   
        return response()->json($data);
    }
    
    public function visa($visaUrl)
    {
        echo $visaUrl = str_replace('-', ' ', $visaUrl);   
    }
    
    public function index()
    {
        return view('home');
    }
    
    public function bologin()
    {
        return view('bologin');
    }
}
