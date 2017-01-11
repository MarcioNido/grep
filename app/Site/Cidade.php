<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Cidade extends Model
{

    use ValidatingTrait;

    protected   $table="i_cidade";
    protected   $primaryKey="codcidade";
    public      $timestamps=false;

    protected $rules=[];

}
