<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    // table name
    protected $table="fotolink";
    protected $primaryKey="foto_id";
    public $timestamps = false;
    
}
