<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent Model for table pfj in bdi database
 * @package App\Site
 */
class Pfj extends Model
{
    protected $connection   = "bdi";
    protected $table        = "pfj";
    protected $primaryKey   = "pfj_id";
    public    $timestamps   = false;
}
