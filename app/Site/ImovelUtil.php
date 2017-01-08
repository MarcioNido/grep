<?php
/**
 * Created by PhpStorm.
 * User: marcionido
 * Date: 2017-01-07
 * Time: 12:50 PM
 */

namespace App\Site;


class ImovelUtil
{

    /**
     * Converts an array of filters or fields to a search description
     * @param array $vars
     * @return array
     */
    static public function searchDescription($vars)
    {
        $filters = [];
        $title = "";

        if (isset($vars['tipo_negocio']) && $vars['tipo_negocio'] == 'venda') {
            $filters['tipo_negocio'] = "Comprar ";
            $title .= "Comprar ";
        }
        if (isset($vars['tipo_negocio']) && $vars['tipo_negocio'] == 'locacao') {
            $filters['tipo_negocio'] = "Alugar ";
            $title .= "Aluguar";
        }

        if (isset($vars['tipo_imovel'])) {
            $filters['tipo_imovel'] = mb_convert_case($vars['tipo_imovel'], MB_CASE_TITLE);
            $title .= mb_convert_case($vars['tipo_imovel'], MB_CASE_TITLE)." ";
        }

        // localizacao
        if (isset($vars['regiao']) || isset($vars['cidade']) || isset($vars['estado'])) {
            $localidade = '';
            if (isset($vars['regiao']) && $vars['regiao'] != '') {
                $localidade .= $vars['regiao'] . ", ";
            }
            $localidade .= $vars['cidade'] . ", " . $vars['estado'];
            $filters['localidade'] = $localidade;
            $title .= " em " . $localidade . " ";
        }

        if ($title != '') $title = substr($title, 0, -1);

        // caracteristicas ...
        $caracteristicas = '';
        if (isset($vars['dormitorios']) && (int)$vars['dormitorios'] != 0) {
            $filters['dormitorios'] = (int)$vars['dormitorios'];
            $caracteristicas .= (int)$vars['dormitorios'] . "+ dorms., ";
        }

        if (isset($vars['vagas']) && (int)$vars['vagas'] != 0) {
            $filters['vagas'] = (int)$vars['vagas'];
            $caracteristicas .= (int)$vars['vagas'] . "+ vagas, ";
        }

        if (isset($vars['area_minima']) && (int)$vars['area_minima'] != 0) {
            $filters['area_minima'] = "Mín " . (int)$vars['area_minima'] . "㎡";
            $caracteristicas .= "Mín " . (int)$vars['area_minima'] . "㎡, ";
        }

        if (isset($vars['area_maxima']) && (int)$vars['area_maxima'] != 0) {
            $filters['area_maxima'] = "Máx " . (int)$vars['area_maxima'] . "㎡";
            $caracteristicas .= "Máx " . (int)$vars['area_maxima'] . "㎡, ";
        }

        if (isset($vars['valor_minimo']) && (float) $vars['valor_minimo'] != 0) {
            $filters['valor_minimo'] = "Mín R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_minimo']);
            $caracteristicas .= "Mín R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_minimo']) . ", ";
        }
        if (isset($vars['valor_maximo']) && (float) $vars['valor_maximo'] != 0) {
            $filters['valor_maximo'] = "Máx R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_maximo']);
            $caracteristicas .= "Máx R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_maximo']) . ", ";
        }
        if ($caracteristicas != '') {
            $caracteristicas = substr($caracteristicas, 0, -2);
        }

        return array(
            'filters'=>$filters,
            'title'=>$title,
            'caracteristicas'=>$caracteristicas,
        );

    }

}