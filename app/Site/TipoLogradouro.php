<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class TipoLogradouro extends Model
{

    use ValidatingTrait;

    protected   $table="i_tipologradouro";
    protected   $primaryKey="codtipologradouro";
    public      $timestamps=false;

    protected $rules=[];

}
