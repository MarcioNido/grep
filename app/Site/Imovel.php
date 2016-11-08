<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    
    // table name
    protected $table = "web_site";
    protected $primaryKey = "imovel_id";
    public $timestamps = false;
    
    
    
}
