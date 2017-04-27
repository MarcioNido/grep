<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class EvtEmailClicado extends Model
{
    // primary key
    protected $primaryKey = "evt_email_clicado_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "evt_email_clicado";

    // timestamps
    public $timestamps=false;

}
