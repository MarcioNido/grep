<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Estado extends Model
{

    use ValidatingTrait;

    protected   $table="i_estado";
    protected   $primaryKey="codestado";
    public      $timestamps=false;

    protected $rules=[];

}
