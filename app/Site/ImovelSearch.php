<?php

namespace App\Site;

use App\Tracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use App\Http\Components\CHtml;

/**
 * Class ImovelSearch
 * @package App\Site
 * @TODO: Improve the log method ... Monolog ...
 */
class ImovelSearch
{
    /**
     * @var Request
     */
    protected $request;

    protected $tracker;

    protected $_condition;

    /**
     * @var array filters
     */
    public $filter=[
        'localidade_url' => 'sp/sao-paulo/todas-as-regioes',
        'estado' => 'SP',
        'cidade' => 'São Paulo',
        'regiao' => 'Todas as Regiões',
        'tipo_negocio' => 'venda',
        'tipo_imovel' => 'apartamento',
        'valor_minimo' => '',
        'valor_maximo' => '',
        'area_minima' => '',
        'area_maxima' => '',
        'dormitorios' => '',
        'vagas' => '',
        'order' => 'Mais Recentes',
        'referencia' => '',
    ];

    public $imoveis;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->tracker = App::make('\App\Tracker');
    }

    /**
     * Process a search request
     * Updates profile
     * Logs the search
     *
     * @return result
     */
    public function processSearchRequest()
    {

        $this->setFilter();
        $qb = $this->getQueryBuilder();

        // retrieve rows
        $this->imoveis = $qb->paginate(10);

        $this->logAction();
        return $this;

    }

    public function processSearchByRefRequest()
    {
        $this->setFilter(true);
        $this->imoveis = $this->imoveis = Imovel::wherein('id', $this->refToArray($this->request->referencia))->paginate(10);
        return $this;
    }

    /**
     * Sets the filter with the request values
     *
     * @throws \Exception
     * @param boolean $force
     */
    protected function setFilter($force=false)
    {

        if ($this->request->isMethod('get') || $force) {
            $this->getSessionFilters();
        }

        foreach($this->filter as $field => $value) {
            if (isset($this->request->$field)) {
                $this->filter[$field] = $this->request->$field;
            }
        }

        // check if we have the localidade_url in the request ...
        // otherwise it is a direct or external link (/venda/sp/sao-paulo/brooklin/casa)
        if (! isset($this->request->localidade_url) && !$force && !isset($this->request->page)) {
            $this->filter['localidade_url'][0] = $this->request->estado.'/'.$this->request->cidade.'/'.$this->request->regiao;
        }

        // gets localidade record
        if (is_array($this->filter['localidade_url'])) {
            $this->filter['localidade'] = [];
            foreach($this->filter['localidade_url'] as $localidade_url) {
                $localidade = Localidade::where('localidade_url', $localidade_url)->first();
                if ($localidade) {
                    $this->filter['localidade'][] = [
                        'estado' => $localidade->estado,
                        'cidade' => $localidade->cidade,
                        'regiao' => $localidade->regiao,
                    ];
                }
            }
        } else {
            $localidade = Localidade::where('localidade_url', $this->filter['localidade_url'])->first();
            if ($localidade) {
                $this->filter['localidade'] = [];
                $this->filter['localidade'][] = [
                    'estado' => $localidade->estado,
                    'cidade' => $localidade->cidade,
                    'regiao' => $localidade->regiao,
                ];
            }
        }

        $this->setSessionFilters();
        $this->setCookies();

    }

    /**
     * Sets the condition to retrieve rows from properties
     */
    protected function getQueryBuilder()
    {
        $qb = Imovel::where(function($query) {
            foreach($this->filter['localidade'] as $localidade) {
                if ($localidade['regiao'] != null) {
                    $query->orWhere(['estado' => $localidade['estado'], 'cidade' => $localidade['cidade'], 'regiao_mercadologica' => $localidade['regiao']]);
                } else {
                    $query->orWhere(['estado' => $localidade['estado'], 'cidade' => $localidade['cidade']]);
                }
            }
        });

        $qb->whereNotNull('pub_agencia_id');

        if ($this->filter['tipo_negocio'] == 'venda') {
           $qb->where(['disponivel_venda' => 1]);
        } else {
            $qb->where(['disponivel_locacao' => 1]);
        }

        $qb->where(['tipo_simplificado' => $this->filter['tipo_imovel']]);
        if (isset($this->filter['dormitorios']) && (int) $this->filter['dormitorios'] != 0) {
            $qb->where('dormitorio', '>=', $this->filter['dormitorios']);
        }
        if (isset($this->filter['vagas']) && (int) $this->filter['vagas'] != 0) {
            $qb->where('vaga', '>=', $this->filter['vagas']);
        }
        if (isset($this->filter['valor_minimo']) && (float) $this->filter['valor_minimo'] != 0.00) {
            if ($this->filter['tipo_negocio'] == 'venda') {
                $qb->where('valor_venda', '>=', CHtml::removeMask($this->filter['valor_minimo']));
            } else {
                $qb->where('valor_locacao', '>=', CHtml::removeMask($this->filter['valor_minimo']));
            }
        }
        if (isset($this->filter['valor_maximo']) && (float) $this->filter['valor_maximo'] != 0.00) {
            if ($this->filter['tipo_negocio'] == 'venda') {
                $qb->where('valor_venda', '<=', CHtml::removeMask($this->filter['valor_maximo']));
            } else {
                $qb->where('valor_locacao', '<=', CHtml::removeMask($this->filter['valor_maximo']));
            }
        }

        // AREA MINIMA
        if (isset($this->filter['area_minima']) && (float) $this->filter['area_minima'] != 0.00) {
            if (in_array($this->filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $qb->where('area_total_terreno', '>=', (float) $this->filter['area_minima']);
            } else {
                $qb->where('area_util_construida', '>=', (float) $this->filter['area_minima']);
            }
        }

        // AREA MAXIMA
        if (isset($this->filter['area_maxima']) && (float) $this->filter['area_maxima'] != 0.00) {
            if (in_array($this->filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $qb->where('area_total_terreno', '<=', (float) $this->filter['area_maxima']);
            } else {
                $qb->where('area_util_construida', '<=', (float) $this->filter['area_maxima']);
            }
        }

        // REFERENCIAS ...
        if (isset($this->filter['referencia']) && trim($this->filter['referencia']) != '') {
            $qb = Imovel::whereIn('id', $this->refToArray($this->filter['referencia']));
        }

        if (isset($this->filter['order']) && $this->filter['order'] != '') {

            if ($this->filter['order'] == "Mais Recentes") {

                $qb->orderBy('created_at', 'desc');

            } elseif ($this->filter['order'] == "Menor Valor") {

                if ($this->filter['tipo_negocio'] == 'venda') {
                    $qb->orderBy('valor_venda');
                } else {
                    $qb->orderBy('valor_locacao');
                }

            } elseif ($this->filter['order'] = "Maior Valor") {

                if ($this->filter['tipo_negocio'] == 'venda') {
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

    protected function refToArray($ref)
    {
        $refs = $ref;
        $refs = str_replace(' ', '|', $refs);
        $refs = str_replace(',', '|', $refs);
        $refs = str_replace(';', '|', $refs);
        $refs = str_replace('-', '|', $refs);
        $refs = str_replace('/', '|', $refs);
        $refs = str_replace("\n", '|', $refs);
        $refs = str_replace("\r", '|', $refs);

        while(strpos($refs, '||') !== false) {
            $refs = str_replace('||', '|', $refs);
        }

        $a_refs = explode('|', $refs);
        return $a_refs;

    }

    /**
     * Saves filters in session
     */
    protected function setSessionFilters()
    {
        $this->request->session()->set('filter', $this->filter);
    }

    /**
     * Gets session filters that are not passed via get
     */
    public function getSessionFilters()
    {
        if ($this->request->session()->has('filter')) {
            foreach($this->request->session()->get('filter') as $key => $value) {
                $this->filter[$key] = $value;
            }
        }
        return $this->filter;
    }


    protected function setCookies()
    {
        Cookie::queue('tipo_negocio', $this->filter['tipo_negocio']);
        Cookie::queue('tipo_imovel', $this->filter['tipo_imovel']);
        Cookie::queue('localidade_url', $this->filter['localidade_url']);
    }

    protected function logAction()
    {
        $this->tracker->register('Pesquisa');
    }

    /**
     * Creates an array with the filter descriptions
     * @return array filter description
     */
    public function getSessionFiltersDesc()
    {

        $filter = $this->getSessionFilters();
        $perfil = [];

        if (isset($filter)) {
            if ($filter['tipo_negocio'] == 'venda') {
                $perfil[] = "Comprar";
            } else {
                $perfil[] = "Alugar";
            }
            $perfil[] = mb_convert_case($filter['tipo_imovel'], MB_CASE_TITLE);
            $localidade = "";
            if (isset($filter['regiao']) && $filter['regiao'] != '') {
                $localidade .= $filter['regiao'] . ", ";
            }
            $localidade .= $filter['cidade'] . ", " . $filter['estado'];
            $perfil[] = $localidade;

            if ($filter['dormitorios'] != '') {
                $perfil[] = $filter['dormitorios'] . " dormitórios";
            }

            if ($filter['vagas'] != '') {
                $perfil[] = $filter['vagas'] . " vagas";
            }

            if (isset($filter['valor_minimo']) && (int)$filter['valor_minimo'] != 0) {
                $perfil[] = "Mín R$ " . \App\Http\Components\CHtml::moneyMask($filter['valor_minimo']);
            }

            if (isset($filter['valor_maximo']) && (int)$filter['valor_maximo'] != 0) {
                $perfil[] = "Máx R$ " . \App\Http\Components\CHtml::moneyMask($filter['valor_maximo']);
            }

            if (isset($filter['area_minima']) && (int)$filter['area_minima'] != 0) {
                $perfil[] = "Min " . $filter['area_minima'] . " ㎡";
            }

            if (isset($filter['area_maxima']) && (int)$filter['area_maxima'] != 0) {
                $perfil[] = "Máx " . $filter['area_maxima'] . " ㎡";
            }

        }

        return $perfil;
    }

}