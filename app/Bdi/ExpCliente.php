<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class ExpCliente extends Model
{
    // primary key
    protected $primaryKey = "cliente_id";

    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "exp_cliente";

    // timestamps
    public $timestamps=false;

}
