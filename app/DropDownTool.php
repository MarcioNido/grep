<?php

namespace App;

use App\Site\Bairro;
use App\Site\Cidade;
use App\Site\Estado;
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

    public static function getEstado()
    {
        return Estado::where(['situacao' => 'Ativo'])
            ->select('sigla')
            ->orderBy('sigla')
            ->pluck('sigla', 'sigla');
    }

    public static function getCidade($estado='')
    {
        return Cidade::where(['siglaestado' => $estado, 'situacao' => 'Ativo'])
            ->select('codcidade', 'descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'codcidade');
    }

    public static function getBairro($codcidade=0)
    {
        return Bairro::where(['codcidade' => $codcidade, 'situacao'=>'Ativo'])
            ->select('codbairro', 'descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'codbairro');
    }

}