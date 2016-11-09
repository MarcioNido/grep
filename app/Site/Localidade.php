<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    public $timestamps=false;
    protected $fillable = ['nome', 'descricao', 'url'];
}
