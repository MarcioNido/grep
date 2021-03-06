<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Bdi
 */
class EvtEmailPP extends Model
{
    // primary key
    protected $primaryKey = "evt_email_enviado_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "evt_email_pp";

    // timestamps
    public $timestamps=false;

}
