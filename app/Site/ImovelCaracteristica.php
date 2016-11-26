<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class ImovelCaracteristica extends Model
{
    // table name
    protected $table = "web_imovel_caracteristica";

    // fillable
    protected $fillable = ['imovel_id', 'caracteristica_id', 'tipo'];

}
