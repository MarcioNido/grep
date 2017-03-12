<?php

namespace App\Http\Controllers\Site;

use App\Http\Components\CHtml;
use App\Site\Profile;
use App\Tracker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Site\Agencia;
use App\Site\Contato;
//use GoogleMaps\GoogleMaps;
//use Illuminate\Support\Facades\Cookie;
use App\Site\NotificacaoImovel;
use Illuminate\Http\Request;
use App\Site\Imovel;
use App\Site\Localidade;
//use App\Http\Components\Html;
use App\Site\ImovelSearch;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
//        $searchResult = (new ImovelSearch($request))->processSearchRequest();
        $searchResult = $this->processSearchRequest($request);
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
//        $searchResult = (new ImovelSearch($request))->processSearchRequest();
        $searchResult = $this->processSearchRequest($request);
        return view('site.pesquisa.resultado', ['searchResult' => $searchResult]);
    }

    public function referencia(Request $request)
    {
        return redirect('imovel/'.$request->imovel_id);
//        $searchResult = (new ImovelSearch($request))->processSearchByRefRequest();
//        return view('site.pesquisa.resultado', ['searchResult' => $searchResult]);
    }

    protected function processSearchRequest(Request $request)
    {
        // check the type of request (post, get, pagination, reference)
        // $requestType = $this->getRequestType($request);

        $profile = Profile::getInstance();
        $filter = $profile->getFilter();
        $filter = array_merge($filter, $request->all());
        if ($request->isMethod('get')) {
            $filter['localidade_url'][0] = $request->estado."/".$request->cidade."/".$request->regiao;
            if (strpos($request->getUri(), '/venda/') !== false) {
                $filter['tipo_negocio'] = 'venda';
            } else {
                $filter['tipo_negocio'] = 'locacao';
            }
            $filter['tipo_imovel'] = $request->tipo_imovel;
        }
        $filter = $this->sanitizeLocalidade($filter);
        $profile->setProfile($filter);

        $qb = $this->getQueryBuilder($filter);
        $imoveis = $qb->paginate(10);

        $titles = $this->setTitles($filter, $imoveis->total());

        return [
            'imoveis' => $imoveis,
            'filter' => $filter,
            'titles' => $titles,
        ];

    }

    /**
     * Sets the condition to retrieve rows from properties
     */
    protected function getQueryBuilder($filter)
    {
        $qb = Imovel::where(function($query) use ($filter) {
            foreach($filter['localidade_url'] as $localidade_url) {
                $localidade = Localidade::where('localidade_url', $localidade_url)->first();
                if ($localidade) {
                    if ($localidade['regiao'] != null) {
                        $query->orWhere(['estado' => $localidade['estado'], 'cidade' => $localidade['cidade'], 'regiao_mercadologica' => $localidade['regiao']]);
                    } else {
                        $query->orWhere(['estado' => $localidade['estado'], 'cidade' => $localidade['cidade']]);
                    }
                }
            }
        });

        $qb->whereNotNull('pub_agencia_id');

        if ($filter['tipo_negocio'] == 'venda') {
            $qb->where(['disponivel_venda' => 1]);
        } else {
            $qb->where(['disponivel_locacao' => 1]);
        }

        $qb->where(['tipo_simplificado' => $filter['tipo_imovel']]);
        if (isset($filter['dormitorios']) && (int) $filter['dormitorios'] != 0) {
            $qb->where('dormitorio', '>=', $filter['dormitorios']);
        }
        if (isset($filter['vagas']) && (int) $filter['vagas'] != 0) {
            $qb->where('vaga', '>=', $filter['vagas']);
        }
        if (isset($filter['valor_minimo']) && (float) $filter['valor_minimo'] != 0.00) {
            if ($filter['tipo_negocio'] == 'venda') {
                $qb->where('valor_venda', '>=', CHtml::removeMask($filter['valor_minimo']));
            } else {
                $qb->where('valor_locacao', '>=', CHtml::removeMask($filter['valor_minimo']));
            }
        }
        if (isset($filter['valor_maximo']) && (float) $filter['valor_maximo'] != 0.00) {
            if ($filter['tipo_negocio'] == 'venda') {
                $qb->where('valor_venda', '<=', CHtml::removeMask($filter['valor_maximo']));
            } else {
                $qb->where('valor_locacao', '<=', CHtml::removeMask($filter['valor_maximo']));
            }
        }

        // AREA MINIMA
        if (isset($filter['area_minima']) && (float) $filter['area_minima'] != 0.00) {
            if (in_array($filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $qb->where('area_total_terreno', '>=', (float) $filter['area_minima']);
            } else {
                $qb->where('area_util_construida', '>=', (float) $filter['area_minima']);
            }
        }

        // AREA MAXIMA
        if (isset($filter['area_maxima']) && (float) $filter['area_maxima'] != 0.00) {
            if (in_array($filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $qb->where('area_total_terreno', '<=', (float) $filter['area_maxima']);
            } else {
                $qb->where('area_util_construida', '<=', (float) $filter['area_maxima']);
            }
        }

        // REFERENCIAS ...
        if (isset($filter['referencia']) && trim($filter['referencia']) != '') {
            $qb = Imovel::whereIn('id', $this->refToArray($filter['referencia']));
        }

        if (isset($filter['order']) && $filter['order'] != '') {

            if ($filter['order'] == "Mais Recentes") {

                $qb->orderBy('created_at', 'desc');

            } elseif ($filter['order'] == "Menor Valor") {

                if ($filter['tipo_negocio'] == 'venda') {
                    $qb->orderBy('valor_venda');
                } else {
                    $qb->orderBy('valor_locacao');
                }

            } elseif ($filter['order'] = "Maior Valor") {

                if ($filter['tipo_negocio'] == 'venda') {
                    $qb->orderBy('valor_venda', 'desc');
                } else {
                    $qb->orderBy('valor_locacao', 'desc');
                }

            } else {
                $qb->orderBy('created_at', 'desc');
            }

        }
        return $qb;
    }


    protected function setTitles($filter, $quant)
    {
        $plural = [
            'apartamento' => 'Apartamentos',
            'casa' => 'Casas',
            'comercial' => 'Imóveis Comerciais',
            'rural' => 'Propriedades Rurais',
            'terreno' => 'Terrenos',
            'flat' => 'Flats',
        ];

        $filter_desc = [];

        $title = mb_convert_case($filter['tipo_imovel'], MB_CASE_TITLE);

        $subtitle  = "<b>".$quant . "</b> ";

        $subtitle .= $plural[$filter['tipo_imovel']];
        if ($filter['tipo_negocio'] == 'venda') {
            $subtitle .= ' à Venda';
            $filter_desc[] = 'Comprar';
        } else {
            $subtitle .= " para Alugar";
            $filter_desc[] = 'Alugar';
        }

        $filter_desc[] = mb_convert_case($filter['tipo_imovel'], MB_CASE_TITLE);

        $first = true;
        foreach($filter['localidade_url'] as $localidade_url) {
            $localidade = Localidade::where('localidade_url', $localidade_url)->first();
            if ($localidade) {
                if ($first) {
                    $subtitle .= ' em '. ($localidade->regiao != null ? mb_convert_case($localidade->regiao, MB_CASE_TITLE). ', ' : '')
                        . mb_convert_case($localidade->cidade, MB_CASE_TITLE) . ', ' . $localidade->estado;
                    $title .= $subtitle;

                    $breadcrumbs = [
                        'tipo_negocio' => $filter['tipo_negocio'] == 'venda' ? 'Venda' : 'Locação',
                        'estado' => $localidade->estado,
                        'cidade' => $localidade->cidade,
                        'regiao' => $localidade->regiao != null ? mb_convert_case($localidade->regiao, MB_CASE_TITLE) : 'Todas as Regiões',
                        'tipo_imovel' => title_case($filter['tipo_imovel']),
                    ];
                    $first = false;
                }
                if ($localidade->regiao != null) {
                    $filter_desc[] = $localidade->regiao.", ".$localidade->cidade.", ".$localidade->estado;
                } else {
                    $filter_desc[] = $localidade->cidade.", ".$localidade->estado;
                }
            }
        }

        if (count($filter['localidade_url']) > 2) {
            $subtitle .= ' e mais ' . (count($filter['localidade_url']) - 1) . ' Regiões';
        } elseif (count($filter['localidade_url']) > 1) {
            $subtitle .= ' e mais ' . (count($filter['localidade_url']) - 1) . ' Região';
        }

        $title .= " - Paulo Roberto Leardi";

        if ($filter['dormitorios'] != '') {
            $filter_desc[] = $filter['dormitorios']." dormitório(s)";
        }

        if ($filter['vagas'] != '') {
            $filter_desc[] = $filter['vagas']." vaga(s)";
        }

        if ($filter['valor_minimo'] != '' && $filter['valor_minimo'] != 0) {
            $filter_desc[] = "Mín R$ ".CHtml::moneyMask($filter['valor_minimo']);
        }

        if ($filter['valor_maximo'] != ''  && $filter['valor_maximo'] != 0) {
            $filter_desc[] = "Máx R$ ".CHtml::moneyMask($filter['valor_maximo']);
        }

        return [
            'title' => $title,
            'subtitle' => $subtitle,
            'breadcrumbs' => $breadcrumbs,
            'filter_desc' => $filter_desc,
        ];

    }


    /**
     * Shows the property's details
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detalhe(Request $request)
    {
        $imovel = Imovel::find($request->imovel_id);
        if ($imovel == null) {
            throw new ModelNotFoundException("Imóvel não encontrado");
        }
        $filter = Profile::getInstance()->getFilter();
        $titles = $this->setTitles($filter, 1);
        $filter_desc = $titles['filter_desc'];
        $imoveisSimilares = $this->getImoveisSimilares($imovel, $filter_desc);
        return view('site.pesquisa.detalhe', ['imovel' => $imovel, 'filter_desc' => $filter_desc, 'imoveisSimilares' => $imoveisSimilares]);
    }

    /**
     * Retorna 4 imóveis similares ...
     * Parametros em ordem de prioridade:
     *  - tipo de negócio
     *  - tipo de imóvel
     *  - estado
     *  - cidade
     *  - região
     *  - faixa de valor
     * @param $imovel
     */
    protected function getImoveisSimilares($imovel, $filter_desc)
    {
        $filtros = array();
        if (in_array('Comprar', $filter_desc)) {
            $filtros['disponivel_venda'] = 1;
        } else {
            $filtros['disponivel_locacao'] = 1;
        }

        $filtros['tipo_simplificado'] = $imovel->tipo_simplificado;
        $filtros['tipo_imovel'] = $imovel->tipo_imovel;
        $filtros['estado'] = $imovel->estado;
        $filtros['cidade'] = $imovel->cidade;
        $filtros['regiao_mercadologica'] = $imovel->regiao_mercadologica;
        $filtros['valor_venda'] = $imovel->valor_venda;
        $filtros['valor_locacao'] = $imovel->valor_locacao;

        for ($i=1; $i<=3; $i++) {
            $imoveis = $this->searchSimilares($filtros, $imovel->id);
            if ($imoveis && count($imoveis) == 4) {
                break;
            }
            if ($i == 1) {
                unset($filtros['regiao_mercadologica']);
            } elseif ($i == 2) {
                unset($filtros['valor_venda']);
                unset($filtros['valor_locacao']);
            }

        }

        return $imoveis;

    }

    protected function searchSimilares($filtros, $id)
    {
        $condition = [];
        foreach($filtros as $key => $value) {
            if ($key == "valor_venda" || $key == "valor_locacao") {
                $valor_minimo = (float) $value * 0.80;
                $valor_maximo = (float) $value * 1.20;
                $condition[] = [$key, '>=', $valor_minimo];
                $condition[] = [$key, '<=', $valor_maximo];
            } else {
                $condition[] = [$key, $value];
            }
        }

        $condition[] = ['id', '!=', $id];
        $imoveis = Imovel::where($condition)->orderBy('created_at', 'desc')->limit(4)->get();

        return $imoveis;


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
        $filter = Profile::getInstance()->getFilter();
//        $filter = (new ImovelSearch($request))->getSessionFilters();
        if (! $filter) {
            throw new \HttpException("Configurações não encontradas", 404);
        }

        $notificacao = new NotificacaoImovel();
        $notificacao->user_id       = Auth::id();
        $notificacao->localidade_url = serialize($filter['localidade_url']);
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

    protected function sanitizeLocalidade($filter)
    {
        if ($filter['localidade_url'] && is_array($filter['localidade_url'])) {
            foreach($filter['localidade_url'] as $key => $localidade) {
                $parts = explode('/', $localidade);
                if (isset($parts[2]) && $parts[2] == 'todas-as-regioes') {
                    // check if there is another localidade with a specific neighborhood ... if so, remove the general one
                    foreach($filter['localidade_url'] as $dupli) {
                        $parts_dupli = explode('/', $dupli);
                        if ($parts[0] == $parts_dupli[0] && $parts[1] == $parts_dupli[1] && $parts[2] != $parts_dupli[2]) {
                            unset($filter['localidade_url'][$key]);
                        }
                    }
                }
            }
        }
        $filter['localidade_url'] = array_values($filter['localidade_url']);
        return $filter;
    }


}
