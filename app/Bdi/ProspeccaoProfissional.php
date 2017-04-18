<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class ProspeccaoProfissional extends Model
{
    // primary key
    protected $primaryKey = "prospeccao_profissional_id";

    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "n1_prospeccao_profissional";

    // timestamps
    public $timestamps=false;

}
