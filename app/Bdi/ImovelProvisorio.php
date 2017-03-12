<?php

namespace App\Bdi;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ImovelProvisorio
 * Eloquent Model for table imovel in production database
 * @package App\Site
 */
class ImovelProvisorio extends Model
{
    protected $connection = "bdi";
    protected $table = "imovel";
    protected $primaryKey = "imovel_id";
    public $timestamps=false;
}
