<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class NotificacaoImovel extends Model
{

    use ValidatingTrait;

    protected $table="web_notificacao_imovel";

    protected $rules=[
        'tipo_negocio' => 'required',
        'tipo_imovel' => 'required',
        'motivo_cancelamento' => 'string|max:2000|nullable',
    ];

}
