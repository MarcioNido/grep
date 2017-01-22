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

    /**
     * @var array filters
     */
    public $filter=[
        'localidade_url' => 'sp/sao-paulo/todas-as-regioes',
        'estado' => 'SP',
        'cidade' => 'São Paulo',
        'tipo_negocio' => 'venda',
        'tipo_imovel' => 'apartamento',
        'valor_minimo' => '',
        'valor_maximo' => '',
        'area_minima' => '',
        'area_maxima' => '',
        'dormitorios' => '',
        'vagas' => '',
        'order' => 'Mais Recentes',
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
        $this->setCondition();

        // retrieve rows
        $this->imoveis = Imovel::where($this->_condition)->orderBy($this->_order_fld, $this->_order_ad)->paginate(10);

        $this->logAction();
        return $this;

    }

    /**
     * Sets the filter with the request values
     */
    protected function setFilter()
    {

        if ($this->request->isMethod('get')) {
            $this->getSessionFilters();
        }

        foreach($this->filter as $field => $value) {
            if (isset($this->request->$field)) {
                $this->filter[$field] = $this->request->$field;
            }
        }

        // check if we have the localidade_url in the request ...
        // otherwise it is a direct or external link (/venda/sp/sao-paulo/brooklin/casa)
        if (! isset($this->request->localidade_url)) {
            $this->filter['localidade_url'] = $this->request->estado.'/'.$this->request->cidade.'/'.$this->request->regiao;
        }

        // gets localidade record
        $localidade = Localidade::where('localidade_url', $this->filter['localidade_url'])->first();
        if ($localidade == null) {
            throw new \Exception("Localidade nao encontrada ...");
        }
        $this->filter['estado']         = $localidade->estado;             // localidade
        $this->filter['cidade']         = $localidade->cidade;             // localidade
        $this->filter['regiao']         = $localidade->regiao;             // localidade

        $this->setSessionFilters();
        $this->setCookies();

    }

    /**
     * Sets the condition to retrieve rows from properties
     */
    protected function setCondition()
    {


        $this->_condition = [];
        if ($this->filter['tipo_negocio'] == 'venda') {
            $this->_condition[] = ['disponivel_venda', 1];
        } else {
            $this->_condition[] = ['disponivel_locacao', 1];
        }
        $this->_condition[] = ['tipo_simplificado', $this->filter['tipo_imovel']];
        $this->_condition[] = ['estado', $this->filter['estado']];
        $this->_condition[] = ['cidade', $this->filter['cidade']];
        if ($this->filter['regiao'] !== NULL) {
            $this->_condition[] = ['regiao_mercadologica', ($this->filter['regiao'])];
        }

        // DORMITORIOS
        if (isset($this->filter['dormitorios']) && (int) $this->filter['dormitorios'] != 0) {
            $this->_condition[] = ['dormitorio', '>=', $this->filter['dormitorios']];
        }

        // VAGAS
        if (isset($this->filter['vagas']) && (int) $this->filter['vagas'] != 0) {
            $this->_condition[] = ['vaga', '>=', $this->filter['vagas']];
        }

        // VALOR MINIMO
        if (isset($this->filter['valor_minimo']) && (float) $this->filter['valor_minimo'] != 0.00) {
            if ($this->filter['tipo_negocio'] == 'venda') {
                $this->_condition[] = ['valor_venda', '>=', CHtml::removeMask($this->filter['valor_minimo'])];
            } else {
                $this->_condition[] = ['valor_locacao', '>=', CHtml::removeMask($this->filter['valor_minimo'])];
            }
        }

        // VALOR MAXIMO
        if (isset($this->filter['valor_maximo']) && (float) $this->filter['valor_maximo'] != 0.00) {
            if ($this->filter['tipo_negocio'] == 'venda') {
                $this->_condition[] = ['valor_venda', '<=', CHtml::removeMask($this->filter['valor_maximo'])];
            } else {
                $this->_condition[] = ['valor_locacao', '<=', CHtml::removeMask($this->filter['valor_maximo'])];
            }
        }

        // AREA MINIMA
        if (isset($this->filter['area_minima']) && (float) $this->filter['area_minima'] != 0.00) {
            if (in_array($this->filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $this->_condition[] = ['area_total_terreno', '>=', (float) $this->filter['area_minima']];
            } else {
                $this->_condition[] = ['area_util_construida', '>=', (float) $this->filter['area_minima']];
            }
        }

        // AREA MAXIMA
        if (isset($this->filter['area_maxima']) && (float) $this->filter['area_maxima'] != 0.00) {
            if (in_array($this->filter['tipo_imovel'], ['terreno', 'rural']) !== false) {
                $this->_condition[] = ['area_total_terreno', '<=', (float) $this->filter['area_maxima']];
            } else {
                $this->_condition[] = ['area_util_construida', '<=', (float) $this->filter['area_maxima']];
            }
        }


        $this->_order_fld = "created_at";
        $this->_order_ad = "desc";


        if (isset($this->filter['order']) && $this->filter['order'] != '') {

            if ($this->filter['order'] == "Mais Recentes") {

                $this->_order_fld = "created_at";
                $this->_order_ad = "desc";

            } elseif ($this->filter['order'] == "Menor Valor") {

                if ($this->filter['tipo_negocio'] == 'venda') {
                    $this->_order_fld = "valor_venda";
                    $this->_order_ad = "asc";
                } else {
                    $this->_order_fld = "valor_locacao";
                    $this->_order_ad = "asc";
                }

            } elseif ($this->filter['order'] = "Maior Valor") {

                if ($this->filter['tipo_negocio'] == 'venda') {
                    $this->_order_fld = "valor_venda";
                    $this->_order_ad = "desc";
                } else {
                    $this->_order_fld = "valor_locacao";
                    $this->_order_ad = "desc";
                }

            }



        }



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
            $this->filter = $this->request->session()->get('filter');
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