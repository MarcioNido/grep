<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class TrabalheConosco extends Model
{
    use ValidatingTrait;

    // table name
    protected $table = "web_trabalhe_conosco";

    // not fillable
    protected $guarded = ['id', 'nome', 'email'];

    // validation
    protected $rules = [
        'nome' => 'required',
        'email' => 'required',
        'cep' => 'required|max:8',
        'tipo_logradouro' => 'required',
        'endereco' => 'required',
        'numero' => 'required',
        'estado' => 'required',
        'codcidade' => 'required',
        'codbairro' => 'required',
        'ddd1' => 'required|max:2',
        'telefone1' => 'required',
        'cpf' => 'required',
    ];


}
