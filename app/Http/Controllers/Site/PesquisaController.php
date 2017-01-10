<?php

namespace App\Http\Controllers\Site;

use App\Http\Components\CHtml;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Site\Agencia;
use App\Site\Contato;
//use GoogleMaps\GoogleMaps;
//use Illuminate\Support\Facades\Cookie;
use App\Site\NotificacaoImovel;
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
     * @param Request $request
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
        $filter_desc = (new ImovelSearch($request))->getSessionFiltersDesc();
        return view('site.pesquisa.detalhe', ['imovel' => $imovel, 'filter_desc' => $filter_desc]);
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
        $contato = new Contato();
        $contato->nome = $request['nome'];
        $contato->email = $request['email'];
        $contato->ddd = $request['ddd'];
        $contato->telefone = $request['telefone'];
        $contato->mensagem = $request['mensagem'];
        $contato->envio_ofertas = $request['envio_ofertas'];
        $contato->imovel_id = $request['imovel_id'];
        $contato->agencia_id = $request['agencia_id'];
        $contato->saveOrFail();

        echo json_encode(['status' => 'ok']);

    }

    public function notificacaoImovel(Request $request)
    {

        // try to create or update a notification
        $filter = (new ImovelSearch($request))->getSessionFilters();
        if (! $filter) {
            throw new \HttpException("Configurações não encontradas", 404);
        }

        $notificacao = new NotificacaoImovel();
        $notificacao->user_id       = Auth::id();
        $notificacao->estado        = $filter['estado'];
        $notificacao->cidade        = $filter['cidade'];
        $notificacao->regiao        = $filter['regiao'];
        $notificacao->tipo_negocio  = $filter['tipo_negocio'];
        $notificacao->tipo_imovel   = $filter['tipo_imovel'];
        $notificacao->valor_minimo  = CHtml::removeMask($filter['valor_minimo']);
        $notificacao->valor_maximo  = CHtml::removeMask($filter['valor_maximo']);
        $notificacao->area_minima   = (int) $filter['area_minima'];
        $notificacao->area_maxima   = (int) $filter['area_maxima'];
        $notificacao->dormitorios   = (int) $filter['dormitorios'];
        $notificacao->vagas         = (int) $filter['vagas'];
        $notificacao->save();

        return redirect('area-restrita/index');

    }

}
