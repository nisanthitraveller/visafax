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
        $countries = $countryObj->where('status', 1)->get()->toArray();
        $new_array = array();
        foreach($countries as $item) {
          $new_array[str_replace(' ', '-', $item['continentName'])][] = $item;
        }
        $dashboard = false;
        if (strpos(\Illuminate\Support\Facades\URL::previous(), 'dashboard') !== false) {
            $dashboard = true;
        }
        return view('welcome')->with(['feeds' => $feeds, 'countries' => $new_array, 'dashboard' => $dashboard]);
    }
    
    public function landing()
    {
        $blogObj = new \App\Models\Blog();
        $countryObj = new Country();
        
        $feeds = $blogObj->getFeeds();
        $countries = $countryObj->where('status', 1)->get()->toArray();
        $new_array = array();
        foreach($countries as $item) {
          $new_array[str_replace(' ', '-', $item['continentName'])][] = $item;
        }
        $position = \Stevebauman\Location\Facades\Location::get()->toArray();
        $dashboard = false;
        if (strpos(\Illuminate\Support\Facades\URL::previous(), 'dashboard') !== false) {
            $dashboard = true;
        }
        return view('landing')->with(['feeds' => $feeds, 'countries' => $new_array, 'countries1' => $countries, 'dashboard' => $dashboard, 'position' => $position]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = [];
        $position = \Stevebauman\Location\Facades\Location::get()->toArray();
        $data1 = Country::select("countryName as name", "id")
                ->where('status', 1)
                ->where("countryName","LIKE","%{$request->input('query')}%")
                ->get()->toArray();
        foreach($data1 as $k => $d) {
            $data[$k]['name'] = $d['name'];
            $data[$k]['key'] = str_replace(' ', '-', $d['name']) . '-visa-from-' . str_replace(' ', '-', $position['countryName']);
            $data[$k]['id'] = $d['id'];
        }
        return response()->json($data);
    }
    
    public function visa($visaUrl, Request $request)
    {
        $arr = explode("-visa-from-", $visaUrl, 2);
        $first = $arr[0];
        $path = $request->path();
        $blogObj = new \App\Models\Blog();
        $country = Country::where("countryName", str_replace('-', ' ', $first))->first()->toArray();
        $feeds = $blogObj->getFeeds();
        if(strpos($path, 'visa1') !== false) {
            return view('visa')->with(['country' => $country, 'feeds' => $feeds]);
        } else {
            return view('visa1')->with(['country' => $country, 'feeds' => $feeds]);
        }
    }
    
    public function visaold($visaUrl)
    {
        $position = \Stevebauman\Location\Facades\Location::get()->toArray();
        return redirect('/visa-application/' . $visaUrl . '-visa-from-' . str_replace(' ', '-', $position['countryName']));
    }
    
    public function index()
    {
        return view('home');
    }
    
    public function bologin()
    {
        return view('bologin');
    }
    
    public function logout () {
        //logout user
        auth()->logout();
        // redirect to homepage
        return redirect('/');
    }
}
