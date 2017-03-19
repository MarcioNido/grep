<?php

namespace App;

use App\Site\Bairro;
use App\Site\Cidade;
use App\Site\Estado;
use App\Site\Localidade;
use App\Site\TipoLogradouro;
use App\Site\TipoSimplificado;
use App\Site\TipoImovel;
use Illuminate\Support\Facades\DB;

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

    public static function getTipoImovelDesc($tipo_simplificado)
    {
        $codtiposimplificado = TipoSimplificado::where(['descricao' => $tipo_simplificado])->value('codtiposimplificado');
        if (! $codtiposimplificado) {
            return [];
        }
        $result = TipoImovel::where(['situacao'=>'Ativo', 'codtiposimplificado'=>$codtiposimplificado])
            ->select('descricao')
            ->orderBy('descricao')
            ->pluck('descricao', 'descricao');

        foreach ($result as $key => $value) {
            $result[$key] = mb_convert_case($value, MB_CASE_TITLE);
        }
        return $result;
    }

    public static function getTipoLogradouro()
    {
        return TipoLogradouro::where(['situacao' => 'Ativo'])
            ->select('codtipologradouro')
            ->orderBy('codtipologradouro')
            ->pluck('codtipologradouro', 'codtipologradouro');
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

    public static function getLocalidade()
    {
        $localidades['Cidades'] = Localidade::where(['tipo' => 1])->select('localidade_url', 'descricao')->orderBy('descricao')->pluck('descricao', 'localidade_url')->toArray();

        $cidades = DB::table('localidades')->select('cidade')->distinct()->where(['tipo' => 2])->orderBy('cidade')->get();
        foreach($cidades as $cidade) {
            $localidades[$cidade->cidade] = Localidade::where(['cidade' => $cidade->cidade, 'tipo' => 2])
                ->select('localidade_url', 'descricao')
                ->orderBy('regiao')->get()
                ->pluck('descricao', 'localidade_url')
                ->toArray();
        }

        return $localidades;

    }

}