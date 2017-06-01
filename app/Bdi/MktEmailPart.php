<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table facbdi_id in bdi database
 * @package App\Site
 */
class MktEmailPart extends Model
{
    // primary key
    protected $primaryKey = "email_part_id";

    // connection
    protected $connection = "crm";

    // table name
    protected $table = "mkt_email_part";

    // timestamps
    public $timestamps=false;

}
