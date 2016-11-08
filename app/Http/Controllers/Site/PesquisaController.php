<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Site\Imovel;

//use Illuminate\Http\Request;

class PesquisaController extends Controller
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
    public function venda($estado="", $cidade="", $regiao="", $tipo_imovel="")
    {
        
        $imoveis = Imovel::where([
                ['disponivel_venda', 1],
                ['tipo_simplificado', mb_strtoupper($tipo_imovel)],
                ['estado', mb_strtoupper($estado)],
                ['cidade', mb_strtoupper($cidade)],
        ])->paginate(10);
        
        
        Cookie::queue('tipo_negocio', 'venda');
        Cookie::queue('estado', $estado);
        Cookie::queue('cidade', $cidade);
        Cookie::queue('regiao', $regiao);
        Cookie::queue('tipo_imovel', $tipo_imovel);
        
        return view('site.pesquisa.resultado', ['imoveis' => $imoveis]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function locacao($estado="", $cidade="", $regiao="", $tipo_imovel="")
    {
        
        Cookie::queue('tipo_negocio', 'locacao');
        Cookie::queue('estado', $estado);
        Cookie::queue('cidade', $cidade);
        Cookie::queue('regiao', $regiao);
        Cookie::queue('tipo_imovel', $tipo_imovel);
        
        return view('site.pesquisa.resultado');
    }
    
    
    public function generate(Request $request)
    {
        
        $localidade = explode(' - ', $request->localidade);
        $estado = mb_strtolower($localidade[1]);
        $cidade = mb_strtolower($localidade[0]);
        $tipo_negocio = $request->tipo_negocio;
        $tipo_imovel = $request->tipo_imovel;
        
        return redirect()->to("/{$tipo_negocio}/{$estado}/{$cidade}/todas-as-regioes/{$tipo_imovel}");
        
    }
    
    
}
