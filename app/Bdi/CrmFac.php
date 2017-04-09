<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class CrmFac extends Model
{
    // primary key
    protected $primaryKey = "fac_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "crm_fac";

    // timestamps
    public $timestamps=false;

}
