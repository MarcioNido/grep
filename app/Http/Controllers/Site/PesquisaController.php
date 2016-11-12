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
    
    protected $_filter;
    
/*    
    protected $_localidadeUrl;
    protected $_estado;
    protected $_cidade;
    protected $_regiao;
    protected $_tipoNegocio;
    protected $_tipoImovel;
    protected $_valorMinimo;
    protected $_valorMaximo;
    protected $_dormitorios;
    protected $_vagas;
    protected $_areaMinima;
    protected $_areaMaxima;
  
 * 
 */  
    /**
     *
     * @var string sql where clause
     */
    protected $_condition;
    
    /**
     *
     * @var string sql order clause
     */
    protected $_order;
    
    
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
     * @return \Illuminate\Http\Response
     */
    public function venda(Request $request)
    {
        $imoveis = $this->processRequest($request, "venda");
        return view('site.pesquisa.resultado', ['imoveis' => $imoveis, 'filter'=>$this->_filter]);
    }

    /**
     * Show the search results - properties for rent
     *
     * @return \Illuminate\Http\Response
     */
    public function locacao(Request $request)
    {
        $imoveis = $this->processRequest($request, "locacao");
        return view('site.pesquisa.resultado', ['imoveis' => $imoveis, 'filter'=>$this->_filter]);
    }
    
    /**
     * Processes get or post requests, prepare de condition, select the records and return the collection with pagination.
     * Saves main options as cookies for further use
     * @param Request $request
     * @param type $tipo_negocio
     * @return type
     */
    protected function processRequest(Request $request, $tipo_negocio)
    {

        
        if ($request->isMethod('post')) {
            
            $this->setPostFilter($request, $tipo_negocio);
            
        } else { 

            $this->setGetFilter($request, $tipo_negocio);
            
        }
        
        
        // sets the condition clause ... 
        $this->setCondition();
        
        // retrieve rows 
        $imoveis = Imovel::where($this->_condition)->orderBy($this->_filter['order'], 'desc')->paginate(10);


        
        // if it is a post, create or update the search cookies
        if ($request->isMethod('post')) {
            
            Cookie::queue('tipo_negocio', $this->_filter['tipo_negocio']);
            Cookie::queue('tipo_imovel', $this->_filter['tipo_imovel']);
            Cookie::queue('localidade_url', $this->_filter['localidade_url']);
            
        }
        
        return $imoveis;
        
    }
    
    /**
     * Sets the filters received by a post request 
     * @param Request $request
     * @param type $tipo_negocio
     */
    protected function setPostFilter(Request $request, $tipo_negocio)
    {

        // clears session filters because they will be sent via post (or not if it is from home)
        $this->clearSessionFilters($request);

        // gets localidade record
        $localidade = Localidade::where('localidade_url', $request->localidade_url)->first();
        if ($localidade == null) {
            abort(404);
        }

        // set filters from post request 
        $this->_filter['localidade_url'] = $request->localidade_url;
        $this->_filter['tipo_negocio']   = $tipo_negocio;                // comes from the route ... 
        $this->_filter['estado']         = $localidade->estado;          // localidade
        $this->_filter['cidade']         = $localidade->cidade;          // localidade
        $this->_filter['regiao']         = $localidade->regiao;          // localidade
        $this->_filter['tipo_imovel']    = $request->tipo_imovel;        // get or post ...

        // optional filters ... may not exist ...

        $this->_filter['valor_minimo']   = $request->valor_minimo;       // post (filter only)
        $this->_filter['valor_maximo']   = $request->valor_maximo;       // post (filter only)
        $this->_filter['area_minima']    = $request->area_minima;        // post (filter only)
        $this->_filter['area_maxima']    = $request->area_maxima;        // post (filter only)

        $this->_filter['dormitorios']    = $request->dormitorios;        // post (filter only)
        $this->_filter['vagas']          = $request->vagas;              // post (filter only)

        $this->_filter['order']          = 'data_cadastro_sk';
        
        // saves the filters in session
        $this->setSessionFilters($request);
            
        
    }
    
    /**
     * Sets the filters when receiving a get request 
     * @param Request $request
     * @param type $tipo_negocio
     */
    protected function setGetFilter(Request $request, $tipo_negocio)
    {
        
        // clerar filters ... 
        $this->_filter = [
            'localidade_url' => '',
            'tipo_negocio' => '',
            'estado' => '',
            'cidade' => '',
            'regiao' => '',
            'tipo_imovel' => '',
            'valor_minimo' => '',
            'valor_maximo' => '',
            'dormitorios' => '',
            'vagas' => '',
            'order' => '',
        ];
        
        // overwrite with filters stored in session 
        $this->getSessionFilters($request);

        // localidade comes from the url, parameter names are given by the route configuration 
        $this->_filter['localidade_url'] = $request->estado.'/'.$request->cidade.'/'.$request->regiao;
        
        // gets localidade record
        $localidade = Localidade::where('localidade_url', $this->_filter['localidade_url'])->first();
        if (! $localidade) {
            abort(404);
        }
        
        // overwrite with filters that come from the url 
        $this->_filter['tipo_negocio']   = $tipo_negocio;                // comes from the route ... 
        $this->_filter['estado']         = $localidade->estado;          // localidade
        $this->_filter['cidade']         = $localidade->cidade;          // localidade
        $this->_filter['regiao']         = $localidade->regiao;          // localidade
        $this->_filter['tipo_imovel']    = $request->tipo_imovel;        // get or post ...

        // saves the filters in session
        $this->setSessionFilters($request);
        
        
    }
    
    /**
     * Sets the condition to retrieve rows from properties 
     */
    protected function setCondition()
    {
        
        
        $this->_condition = [];
        if ($this->_filter['tipo_negocio'] == 'venda') {
            $this->_condition[] = ['disponivel_venda', 1];
        } else { 
            $this->_condition[] = ['disponivel_locacao', 1];
        }
        $this->_condition[] = ['tipo_simplificado', $this->_filter['tipo_imovel']];
        $this->_condition[] = ['estado', $this->_filter['estado']];
        $this->_condition[] = ['cidade', $this->_filter['cidade']];
        if ($this->_filter['regiao'] !== NULL) {
            $this->_condition[] = ['regiao_mercadologica', ($this->_filter['regiao'])];
        }
        if (isset($this->_filter['dormitorios']) && (int) $this->_filter['dormitorios'] != 0) {
            $this->_condition[] = ['dormitorio', '>=', $this->_filter['dormitorios']];
        }
        
        
    }
    
    /**
     * Saves filters in session
     */
    protected function setSessionFilters(Request $request)
    {
        
        $request->session()->set('filter', $this->_filter);
        
    }
    
    /**
     * Gets session filters that are not passed via get 
     */
    protected function getSessionFilters(Request $request)
    {
        
        if ($request->session()->has('filter')) {
            
            $this->_filter = $request->session()->get('filter');
        }
        
    }
    
    /**
     * Clears the session filters 
     * @param Request $request
     */
    protected function clearSessionFilters(Request $request)
    {
        
        if ($request->session()->has('filter')) {
            $request->session()->remove('filter');
        }
        
    }
    
/*    
    public function generate(Request $request)
    {

        
        
        if ($request->isMethod('post')) {
            

            $localidade_url = $request->localidade_url;
            $tipo_negocio = $request->tipo_negocio;
            $tipo_imovel = $request->tipo_imovel;

            Cookie::queue('tipo_negocio', $tipo_negocio);
            Cookie::queue('tipo_imovel', $tipo_imovel);
            Cookie::queue('localidade_url', $request->localidade_url);
            
            $request->session()->put('tipo_negocio', $tipo_negocio);
            $request->session()->put('tipo_imovel', $tipo_imovel);
            $request->session()->put('localidade_url', $request->localidade_url);
            
        } else { 
            
            $tipo_negocio = $request->session()->get('tipo_negocio');
            $tipo_imovel = $request->session()->get('tipo_imovel');
            $localidade_url = $request->session()->get('localidade_url');
            
            //return $request->session()->all();
            
        }

        $localidade = Localidade::where('localidade_url', $localidade_url)->first();
        
        $condition = [];
        if ($tipo_negocio == 'venda') {
            $condition[] = ['disponivel_venda', 1];
        } else { 
            $condition[] = ['disponivel_locacao', 1];
        }
        $condition[] = ['tipo_simplificado', mb_strtoupper($tipo_imovel)];
        $condition[] = ['estado', $localidade->estado];
        $condition[] = ['cidade', $localidade->cidade];
        if ($localidade->tipo == 2) {
            $condition[] = ['regiao_mercadologica', ($localidade->regiao)];
        }
        
        $imoveis = Imovel::where($condition)->paginate(10);

        
    }
    
 * 
 */
    
/*    
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
  
 * 
 */  
    
}
