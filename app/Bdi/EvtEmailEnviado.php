<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class EvtEmailEnviado extends Model
{
    // primary key
    protected $primaryKey = "evt_email_enviado_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "evt_email_enviado";

    // timestamps
    public $timestamps=false;

}
