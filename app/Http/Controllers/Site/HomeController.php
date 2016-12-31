<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Site\Profile;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.home', ['cookie' => request()->cookie(), 'profile'=>Profile::getInstance()] );
    }
}
