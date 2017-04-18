<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Site\Agencia;
use App\Site\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = Profile::getInstance()->getFilter();
        return view('site.home', ['filter'=>$filter]);
    }

    public function admin(Request $request)
    {
        if ($request->action == "logs") {
            shell_exec('chmod -R 777 /var/www/grep/storage/logs');
            return "OK";
        }
    }

}
