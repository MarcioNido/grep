<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class MktEmailResposta extends Model
{
    // primary key
    protected $primaryKey = "email_enviado_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "mkt_email_resposta";

    // timestamps
    public $timestamps=false;

}
