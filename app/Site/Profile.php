<?php
namespace App\Site;

use Illuminate\Support\Facades\Cookie;
use App\Site\Localidade;

/**
 * User profile preferences
 *
 * @author Marcio Nido <marcionido@gmail.com>
 */
class Profile {
    
    protected $has_profile=false;
    protected $tipo_negocio;
    protected $tipo_imovel;
    protected $localidade_url;

    public function __construct() 
    {
        
        $this->has_profile = Cookie::get('has_profile');
        if ($this->has_profile) {
            $this->tipo_negocio = Cookie::get('tipo_negocio');
            $this->tipo_imovel = Cookie::get('tipo_imovel');
            $this->localidade_url = Cookie::get('localidade_url');
        } else {
            // try to set a profile from localization 
            $this->createProfile();
        }
        
    }

    protected function createProfile() 
    {
        
        $this->has_profile = true;
        $this->tipo_negocio = 'Comprar';    // default
        $this->tipo_imovel = 'Apartamento'; // default
        
        try { 
            
            $json = file_get_contents('http://ip-api.com/json/200.155.6.231');
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
    

    
    
    
}
