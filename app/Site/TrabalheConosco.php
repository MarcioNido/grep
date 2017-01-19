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
    protected $rules = [];


}
