<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use App\Site\Agencia;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Site\Imovel;
use App\Site\Localidade;
use App\Http\Components\CHtml;
use Illuminate\Support\Facades\DB;

//use Illuminate\Http\Request;

class AgenciaController extends Controller
{

    /**
     * Show the list for agencias
     *
     * @return \Illuminate\Http\Response
     */
    public function lista(Request $request)
    {
        $agencias = Agencia::where(['estagio'=>'1 - ATIVO'])->orderByRaw('foto desc, nome')->get();
        return view('site.agencia.lista', ['agencias' => $agencias]);
    }

    public function search(Request $request)
    {
        $agencias = Agencia::where(['estagio' => 1])->where(function($query) use ($request) {
            $query->where('cidade', 'like', "%{$request->term}%");
            $query->orWhere('nome', 'like', "%{$request->term}%");
            $query->orWhere('bairro', 'like', "%{$request->term}%");
        })->orderByRaw('foto desc, nome')->get();
        return view('site.agencia.lista', ['agencias' => $agencias, 'term' => $request->term]);
    }


}
