<?php
namespace App\Site;

use Illuminate\Support\Facades\Cookie;
use App;

/**
 * User profile preferences
 * Some properties are stored in cookies, some in session var
 * If the user is authenticated the properties are persisted in db
 *
 * @author Marcio Nido <marcionido@gmail.com>
 */
class Profile {
    
    protected $has_profile=false;
    protected $tipo_negocio;
    protected $tipo_imovel;
    protected $localidade_url;
    protected $estado;
    protected $cidade;
    protected $regiao;
    protected $valor_minimo;
    protected $valor_maximo;
    protected $dormitorios;
    protected $vagas;
    protected $order;

    protected $cookieVars = ['has_profile', 'tipo_negocio', 'tipo_imovel', 'localidade_url'];

    private static $instance;

    static public function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Profile();
        }
        self::$instance->getProfile();
        return self::$instance;
    }

    public function __construct()
    {
        // do not create a new instance ...
    }

    /**
     * Tries to load the profile from session vars.
     * If it is not possible, tries to retrieve it from cookies.
     * If it is not possible, creates a new profile
     */
    public function getProfile()
    {

        $this->getProfileFromSession();

        if (! isset($this->has_profile) || $this->has_profile == null) {
            $this->getProfileFromCookies();
            if ($this->has_profile == false) {
                $this->createProfile();
            }
        }



    }

    protected function getProfileFromSession()
    {
        if (session()->has('has_profile')) {
            $this->has_profile = session('has_profile');
            $this->tipo_imovel = session('tipo_imovel');
            $this->localidade_url = session('localidade_url');
            $this->estado = session('estado');
            $this->cidade = session('cidade');
            $this->regiao = session('regiao');
            $this->valor_minimo = session('valor_minimo');
            $this->valor_maximo = session('valor_maximo');
            $this->dormitorios = session('dormitorios');
            $this->vagas = session('vagas');
            $this->order = session('order');
        }
    }

    protected function getProfileFromCookies()
    {
        $this->has_profile = Cookie::get('has_profile');
        if ($this->has_profile) {
            $this->tipo_negocio = Cookie::get('tipo_negocio');
            $this->tipo_imovel = Cookie::get('tipo_imovel');
            $this->localidade_url = Cookie::get('localidade_url');
        }
    }

    protected function createProfile()
    {
        
        $this->has_profile = true;
        $this->tipo_negocio = 'Comprar';    // default
        $this->tipo_imovel = 'Apartamento'; // default
        
        try { 
              // for testing, you can pass an ip
//            $json = file_get_contents('http://ip-api.com/json/200.155.6.231');
            $json = file_get_contents('http://ip-api.com/json');
            $obj = json_decode($json);
            if (isset($obj->city) && isset($obj->region)) {
                $localidade = $obj->city ." - ". $obj->region;
            } else {
                $localidade = "";
            }
            
            
        } catch (Exception $ex) {
            // something went wrong here ... 
            $localidade = "São Paulo - SP"; // default
        }
        
        // try to find the url
        $this->localidade_url = Localidade::where('descricao', $localidade)->value('localidade_url');
        if ($this->localidade_url == null) {
            $this->localidade_url = "";
        }
        
        // sets cookies ... 
        Cookie::queue('has_profile', $this->has_profile);
        Cookie::queue('tipo_negocio', $this->tipo_negocio);
        Cookie::queue('tipo_imovel', $this->tipo_imovel);
        Cookie::queue('localidade_url', $this->localidade_url);
        
    }
    
    public function __get($name) {
        return $this->$name;
    }

    public function __set($name, $value) {
        $this->$name = $value;
        session($name, $value);
        if (in_array($name, $this->cookieVars)) {
            Cookie::queue($name, $value);
        }
    }

}
