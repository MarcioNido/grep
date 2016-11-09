<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Site\Imovel;
use App\Site\Localidade;

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
                
        //return request()->fullUrl();
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function locacao($estado="", $cidade="", $regiao="", $tipo_imovel="")
    {
        
        
        return view('site.pesquisa.resultado');
    }
    
    
    public function generate(Request $request)
    {

        if ($request->isMethod('post')) {
            $localidade = explode(' - ', $request->localidade);
            if (count($localidade) == 3) {
                // tem regiao
                $estado = mb_strtolower($localidade[2]);
                $cidade = mb_strtolower($localidade[1]);
                $regiao = mb_strtolower($localidade[0]);
            } else {
                // so cidade
                $estado = mb_strtolower($localidade[1]);
                $cidade = mb_strtolower($localidade[0]);
                $regiao = 'todas-as-regioes';
            }
            $tipo_negocio = $request->tipo_negocio;
            $tipo_imovel = $request->tipo_imovel;


            Cookie::queue('tipo_negocio', $tipo_negocio);
            Cookie::queue('estado', $estado);
            Cookie::queue('cidade', $cidade);
            Cookie::queue('regiao', $regiao);
            Cookie::queue('tipo_imovel', $tipo_imovel);
            Cookie::queue('localidade', $request->localidade);
            
            $request->session()->put('tipo_negocio', $tipo_negocio);
            $request->session()->put('estado', $estado);
            $request->session()->put('cidade', $cidade);
            $request->session()->put('regiao', $regiao);
            $request->session()->put('tipo_imovel', $tipo_imovel);
            $request->session()->put('localidade', $request->localidade);
            
        } else { 
            
            $tipo_negocio = $request->session()->get('tipo_negocio');
            $estado = $request->session()->get('estado');
            $cidade = $request->session()->get('cidade');
            $regiao = $request->session()->get('regiao');
            $tipo_imovel = $request->session()->get('tipo_imovel');
            $localidade = $request->session()->get('localidade');
            
            //return $request->session()->all();
            
        }
            
        $imoveis = Imovel::where([
                ['disponivel_venda', 1],
                ['tipo_simplificado', mb_strtoupper($tipo_imovel)],
                ['estado', mb_strtoupper($estado)],
                ['cidade', mb_strtoupper($cidade)],
                ['regiao_mercadologica', mb_strtoupper($regiao)],
        ])->paginate(10);
        
        return view('site.pesquisa.resultado', ['imoveis' => $imoveis]);
        
    }
    
    public function aclocalidade()
    {
        $term = request()->get('term');
        
        $localidades = Localidade::where('nome', 'like', "%{$term}%")->take(30)->get();
        $results = [];
        foreach($localidades as $loc) {
            $results[] = ['id' => $loc->url, 'value' => $loc->descricao];
        } 

        
        return \Illuminate\Support\Facades\Response::json($results);
        
    }
    
    
}
