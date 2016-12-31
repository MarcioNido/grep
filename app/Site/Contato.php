<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Contato
 * Eloquent Model for table web_contato (contatos do site)
 * @package App\Site
 */
class Contato extends Model
{
    // table name
    protected $table = "web_contato";

    public function imovel()
    {
        return $this->belongsTo('App\Site\Imovel');
    }

    public function agencia()
    {
        return $this->belongsTo('App\Site\Agencia');
    }

}
