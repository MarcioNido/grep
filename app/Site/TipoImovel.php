<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class TipoImovel extends Model
{

    use ValidatingTrait;

    protected   $table="tipoimovel";
    protected   $primaryKey="codtipoimovel";
    public      $timestamps=false;

    protected $rules=[];

}
