<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Agencia
 * Eloquent Model for table web_agencia
 * @package App\Site
 */
class FacBdi extends Model
{
    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "facbdi";

    // timestamps
    public $timestamps=false;

}
