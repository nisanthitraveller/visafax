<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $feeds = $blogObj->getFeeds();
        return view('welcome')->with(['feeds' => $feeds]);
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
