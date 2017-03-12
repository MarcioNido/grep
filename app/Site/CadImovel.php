<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class CadImovel extends Model
{

    use ValidatingTrait;

    protected $table="web_cad_imovel";

    protected $guarded = ['id'];

    public $timestamps=false;

    protected $rules=[
        'user_id' => 'required',
        'codtiposimplificado' => 'required',
        'codtipoimovel' => 'required',
        'motivo_cancelamento' => 'string|max:2000|nullable',
        'cep' => 'required',
        'endereco' => 'required',
        'numero' => 'required',
        'unidade' => 'integer|nullable',
        'codbairro' => 'required',
        'codcidade' => 'required',
        'estado' => 'required',
        'nome' => 'required',
        'telefone1' => 'required|max:9',
        'telefone2' => 'max:9|nullable',
        'email' => 'email|required',
        'nascimento' => 'date|nullable',
    ];

    public function getEnderecoCompleto()
    {
        $endereco = $this->tipo_logradouro." ".mb_convert_case($this->endereco, MB_CASE_TITLE).", ".$this->numero;
        if ($this->unidade) {
            $endereco .= " Und: ".$this->unidade;
        }
        if ($this->bloco) {
            $endereco .= " Bl.: ".$this->bloco;
        }
        if ($this->complemento) {
            $endereco .= " ".$this->complemento;
        }

        return $endereco;

    }

    public function tipoImovel()
    {
        return $this->belongsTo('App\Site\TipoImovel', 'codtipoimovel', 'codtipoimovel');
    }

    public function tipoSimplificado()
    {
        return $this->belongsTo('\App\Site\TipoSimplificado', 'codtiposimplificado', 'codtiposimplificado');
    }

    public function bairro()
    {
        return $this->belongsTo('\App\Site\Bairro', 'codbairro', 'codbairro');
    }

    public function cidade()
    {
        return $this->belongsTo('\App\Site\Cidade', 'codcidade', 'codcidade');
    }

    public function agencia()
    {
        return $this->belongsTo('App\Site\Agencia');
    }

}
