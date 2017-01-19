<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

/**
 * Class ContatoFranqueado
 * Eloquent Model for table web_contato_franqueado (contatos de franquia)
 * @package App\Site
 */
class ContatoFranqueado extends Model
{
    use ValidatingTrait;

    protected $rules = [
            'nome' => 'required|max:100',
            'email' => 'required|email|max:100',
            'ddd'=>'digits:2',
            'telefone'=>'digits_between:8,9',
        ];

    // table name
    protected $table = "web_contato_franqueado";


}
