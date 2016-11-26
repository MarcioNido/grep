<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Foto
 * Eloquent Model for table web_foto
 * @package App\Site
 */
class Foto extends Model
{
    // table name
    protected $table = "web_foto";

    /**
     * Relation to properties table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function imovel()
    {
        return $this->belongsTo('App\Site\Imovel');
    }

}
