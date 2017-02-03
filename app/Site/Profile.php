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

    public $filter;
    private static $instance;

    static public function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new Profile();
        }
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
    public function getFilter()
    {
        $filter = $this->getProfileFromSession();
        if (! $filter) {
            $filter = $this->getProfileFromCookies();
        }
        if (! $filter) {
            $filter = $this->createProfile();
        }
        return $filter;
    }

    protected function getProfileFromSession()
    {
        return session('filter');
    }

    protected function getProfileFromCookies()
    {
        return Cookie::get('filter');
    }

    protected function createProfile()
    {
        try {
            $json = file_get_contents('http://ip-api.com/json');
            $obj = json_decode($json);
            if (isset($obj->city) && isset($obj->region)) {
                $cidade = $obj->city ." - ". $obj->region;
            } else {
                $cidade = "";
            }
        } catch (Exception $ex) {
            $cidade = "São Paulo - SP"; // default
        }
        // try to find the url
        $localidade_url = Localidade::where('descricao', $cidade)->value('localidade_url');
        if ($localidade_url == null) {
            $localidade_url = 'sp/sao-paulo/todas-as-regioes';
        }

        $filter = [
            'tipo_negocio' => 'venda',
            'tipo_imovel' => 'apartamento',
            'localidade_url' => [$localidade_url],
        ];

        $this->setProfile($filter);
        return $filter;
    }

    public function setProfile($filter)
    {
        session('filter', $filter);
        cookie('filter', $filter);
    }
    
}
