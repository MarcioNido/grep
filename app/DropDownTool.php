<?php

namespace App;

use App\Site\TipoLogradouro;
use App\Site\TipoSimplificado;
use App\Site\TipoImovel;

class DropDownTool
{

    public static function getTipoSimplificado()
    {
        return TipoSimplificado::where(['situacao'=>'Ativo'])
            ->select('codtiposimplificado', 'descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'codtiposimplificado');
    }

    public static function getTipoImovel($codtiposimplificado=0)
    {
        if ($codtiposimplificado == null || $codtiposimplificado == "") {
            $codtiposimplificado = 0;
        }
        return TipoImovel::where(['situacao'=>'Ativo', 'codtiposimplificado'=>$codtiposimplificado])
            ->select('codtipoimovel', 'descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'codtipoimovel');
    }

    public static function getTipoLogradouro()
    {
        return TipoLogradouro::where(['situacao' => 'Ativo'])
            ->select('codtipologradouro', 'descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'codtipologradouro');
    }

}