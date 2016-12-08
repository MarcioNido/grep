<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agencia
 * Eloquent Model for table web_agencia
 * @package App\Site
 */
class Agencia extends Model
{
    // table name
    protected $table = "web_agencia";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imoveisPublicados()
    {
        return $this->hasMany('App\Site\Imovel', 'pub_agencia_id', 'id');
    }

}
