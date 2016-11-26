<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Caracteristica
 * Eloquent Model for table web_caracteristica
 * @package App\Site
 */
class Caracteristica extends Model
{
    // table name
    protected $table = "web_caracteristica";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imoveis()
    {
        return $this->belongsToMany('App\Site\Imovel', 'web_imovel_caracteristica', 'caracteristica_id', 'imovel_id');
    }

}
