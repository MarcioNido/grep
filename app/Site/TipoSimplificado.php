<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class TipoSimplificado extends Model
{

    use ValidatingTrait;

    protected   $table="tiposimplificado";
    protected   $primaryKey="codtiposimplificado";
    public      $timestamps=false;

    protected $rules=[];

}
