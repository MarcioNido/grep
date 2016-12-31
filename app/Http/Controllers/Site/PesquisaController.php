<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Site\Agencia;
use App\Site\Contato;
//use GoogleMaps\GoogleMaps;
//use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Site\Imovel;
//use App\Site\Localidade;
//use App\Http\Components\Html;
use App\Site\ImovelSearch;

//use Illuminate\Http\Request;

class PesquisaController extends Controller
{
    /**
     * @var array filters
     */
    protected $_filter;
    /**
     * @var string sql where clause
     */
    protected $_condition;
    
    /**
     *
     * @var string sql order clause
     */
    protected $_order_fld;
    protected $_order_ad;
    
    
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
     * Show the search results - properties for sale
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function venda(Request $request)
    {
        $searchResult = (new ImovelSearch($request))->processSearchRequest();
        return view('site.pesquisa.resultado', ['searchResult' => $searchResult]);
    }

    /**
     * Show the search results - properties for rent
     *
     * @return \Illuminate\Http\Response
     */
    public function locacao(Request $request)
    {
        $searchResult = (new ImovelSearch($request))->processSearchRequest();
        return view('site.pesquisa.resultado', ['searchResult' => $searchResult]);
    }


    /**
     * Shows the property's details
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detalhe(Request $request)
    {
        $imovel = Imovel::find($request->imovel_id);
        return view('site.pesquisa.detalhe', ['imovel' => $imovel]);
    }


    /**
     * Returns the agency phone
     * @param $agencia_id
     * @return string agency phone
     */
    public function fone($agencia_id)
    {
        $agencia = Agencia::find($agencia_id);
        echo $agencia->ddd1." ".$agencia->telefone1;
    }




    /**
     * @param $id
     */
    public function getCoordinates($id)
    {
        $address = Imovel::find($id)->enderecoGoogle();
        echo \GoogleMaps::load('geocoding')->setParam(['address' => $address])->get();
    }

    public function storeContato(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:100',
            'email' => 'required|email|max:100',
            'ddd'=>'digits:2',
            'telefone'=>'digits_between:8,9',
        ]);

        $contato = new Contato();
        $contato->nome = $request['nome'];
        $contato->email = $request['email'];
        $contato->ddd = $request['ddd'];
        $contato->telefone = $request['telefone'];
        $contato->mensagem = $request['mensagem'];
        $contato->envio_ofertas = $request['envio_ofertas'];
        $contato->imovel_id = $request['imovel_id'];
        $contato->agencia_id = $request['agencia_id'];
        $contato->save();

        echo json_encode(['status' => 'ok']);

    }

}
