<?php
namespace App\Site;

use Illuminate\Support\Facades\Cookie;

/**
 * User profile preferences
 *
 * @author Marcio Nido <marcionido@gmail.com>
 */
class Profile {
    
    protected $has_profile=false;
    protected $tipo_negocio;
    protected $tipo_imovel;
    protected $localidade;

    public function __construct() 
    {
        
        $this->has_profile = Cookie::get('has_profile');
        if ($this->has_profile) {
            $this->tipo_negocio = Cookie::get('tipo_negocio');
            $this->tipo_imovel = Cookie::get('tipo_imovel');
            $this->localidade = Cookie::get('localidade');
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
            
            $json = file_get_contents('http://ip-api.com/json');
            $obj = json_decode($json);
            if (isset($obj->city) && isset($obj->region)) {
                $this->localidade = $obj->city ." - ". $obj->region;
            } else {
                $this->localidade = "";
            }
            
            
        } catch (Exception $ex) {
            // something went wrong here ... 
            $this->localidade = "São Paulo - SP"; // default
        }

        // sets cookies ... 
        Cookie::queue('has_profile', $this->has_profile);
        Cookie::queue('tipo_negocio', $this->tipo_negocio);
        Cookie::queue('tipo_imovel', $this->tipo_imovel);
        Cookie::queue('localidade', $this->localidade);
        
        
    }
    
    public function __get($name) {
        return $this->$name;
    }
    

    
    
    
}
