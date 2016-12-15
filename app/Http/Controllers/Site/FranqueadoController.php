<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Site\Profile;

use Illuminate\Http\Request;

class FranqueadoController extends Controller
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
     * Show the Seja um Franqueado Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.franqueado.seja_um_franqueado');
    }
}
