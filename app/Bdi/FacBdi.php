<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class FacBdi extends Model
{
    // primary key
    protected $primaryKey = "facbdi_id";

    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "facbdi";

    // timestamps
    public $timestamps=false;

}
