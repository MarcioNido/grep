<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class NotificacaoImovel extends Model
{

    protected $table="web_notificacao_imovel";

    public function getDescription()
    {

        return "Comprar Apartamento em Brooklin, São Paulo, SP";
    }

}
