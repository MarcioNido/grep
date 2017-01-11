<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Bairro extends Model
{

    use ValidatingTrait;

    protected   $table="i_bairro";
    protected   $primaryKey="codbairro";
    public      $timestamps=false;

    protected $rules=[];

}
