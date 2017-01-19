<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;
use Watson\Validating\ValidatingTrait;

class Cep extends Model
{

    use ValidatingTrait;

    protected   $table="i_cep";
    protected   $primaryKey="codcep";
    public      $timestamps=false;

    protected $rules=[];

    public function cidade()
    {
        return $this->belongsTo('\App\Site\Cidade', 'codcidade', 'codcidade');
    }

}
