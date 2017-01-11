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
        'codbairro' => 'required',
        'codcidade' => 'required',
        'estado' => 'required',
        'nome' => 'required',
        'telefone1' => 'required',
        'email' => 'required',
    ];

}
