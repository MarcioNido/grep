<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImovelProvisorio
 * Eloquent Model for table imovel in production database
 * @package App\Site
 */
class ImovelProfissional extends Model
{
    // connection
    protected $connection = "bdi";

    // table name
    protected $table = "imovelprofissional";

    // timestamps
    public $timestamps=false;

}
