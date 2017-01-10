<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

/**
 * Class Contato
 * Eloquent Model for table web_contato (contatos do site)
 * @package App\Site
 */
class Contato extends Model
{
    use ValidatingTrait;

    protected $rules = [
            'nome' => 'required|max:100',
            'email' => 'required|email|max:100',
            'ddd'=>'digits:2',
            'telefone'=>'digits_between:8,9',
        ];

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
