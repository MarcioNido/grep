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

//    protected function getFilter()
//    {
//        $has_profile = Session::get('has_profile');
//        if ($has_profile) {
//            return Session::get('filter');
//        } else {
//            $has_profile = Cookie::get('has_profile');
//            if ($has_profile) {
//                $filter['tipo_negocio'] = Cookie::get('tipo_negocio');
//                $filter['tipo_imovel'] = Cookie::get('tipo_imovel');
//                $filter['localidade_url'] = Cookie::get('localidade_url');
//                return $filter;
//            }
//        }
//
//        return [
//            'tipo_negocio'   => 'venda',
//            'tipo_imovel'    => 'apartamento',
//            'localidade_url' => ['sp/sao-paulo/todas-as-regioes'],
//        ];
//
//    }
}
