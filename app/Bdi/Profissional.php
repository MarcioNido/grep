<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Profissional
 * Eloquent Model for table profissional in production database
 * @package App\Site
 */
class Profissional extends Model
{
    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "profissional";

    // timestamps
    public $timestamps=false;

}
