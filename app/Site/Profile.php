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
        $this->filter = $this->getProfileFromSession();
        if (! $this->filter) {
            $this->filter = $this->getProfileFromCookies();
        }
        if (! $this->filter) {
            $this->filter = $this->createProfile();
        }

        if ($this->filter['estado'] == "") {
            $this->getLocalidadeUrl();
        }

        return $this->filter;
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
        $this->filter = [
            'tipo_negocio' => 'venda',
            'tipo_imovel' => 'apartamento',
            'subtipo_imovel' => '',
            'estado' => '',
            'codcidade' => '',
            'codbairro' => [],
            'valor_minimo' => '',
            'valor_maximo' => '',
            'dormitorios' => '',
            'vagas' => '',
            'area_minima' => '',
            'area_maxima' => '',
            'order' => 'Mais Recentes',
        ];

        $this->setProfile($this->filter);
        return $this->filter;
    }

    public function setProfile($filter)
    {
        session('filter', $filter);
        Cookie::queue('filter', $filter);
    }

    protected function getLocalidadeUrl()
    {
        try {
            $json = file_get_contents('http://ip-api.com/json');
            $obj = json_decode($json);
            if (isset($obj->city) && isset($obj->region)) {
                if ($obj->regionName == 'Federal District') {
                    $this->filter['estado'] = 'DF';
                    $this->filter['codcidade'] = 1778;
                } else {
                    $this->filter['estado'] = $obj->region;
                    $cidade = Cidade::where('siglaestado',$obj->region)->where('descricao', $obj->city)->first();
                    if ($cidade) {
                        $this->filter['codcidade'] = $cidade->codcidade;
                    }
                }
            }
        } catch (Exception $ex) {
            $cidade = "São Paulo - SP"; // default
        }

    }

    public function getUrl()
    {
        $cidade = Cidade::where(['codcidade' => $request->codcidade])->first();
        if ($request->codbairro) {
            $regiao = Bairro::where(['codbairro' => $request->codbairro])->first();
            $url = Localidade::where(['estado' => $request->estado, 'cidade'=>$cidade->descricao, 'regiao' => $regiao->descricao])->first();
        } else {
            $url = Localidade::where(['estado' => $request->estado, 'cidade'=>$cidade->descricao])->whereNull('regiao')->first();
        }

        return $request->tipo_negocio.'/'.$url->localidade_url.'/'.$request->tipo_imovel;
    }
    
}
