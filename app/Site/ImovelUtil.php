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
        $title = "";

        if (isset($vars['tipo_negocio']) && $vars['tipo_negocio'] == 'venda') {
            $title .= "Comprar ";
        }
        if (isset($vars['tipo_negocio']) && $vars['tipo_negocio'] == 'locacao') {
            $title .= "Alugar ";
        }

        if (isset($vars['tipo_imovel'])) {
            $title .= mb_convert_case($vars['tipo_imovel'], MB_CASE_TITLE)." ";
        }

        if (isset($vars['codcidade'])) {
            $cidade = Cidade::where('codcidade', $vars['codcidade'])->first();
        } else {
            $cidade = '';
        }

        $codbairro = unserialize($vars['codbairro']);
        if (isset($codbairro) && $codbairro != null && count($codbairro) > 0) {
            foreach($codbairro as $bairro) {
                if ($bairro != "") {
                    $rowBairro = Bairro::where('codbairro', $bairro)->first();
                    $title .= mb_convert_case($rowBairro->descricao . ' - ' . $cidade->descricao, MB_CASE_TITLE) . ' - ' . $vars['estado'] . ', ';
                }
            }
        } else {
            $title .= $cidade->descricao. ' - '.$vars['estado']. ', ';
        }

        if ($title != '') $title = substr($title, 0, -2);

        // caracteristicas ...
        $caracteristicas = '';
        if (isset($vars['dormitorios']) && (int)$vars['dormitorios'] != 0) {
            $caracteristicas .= (int)$vars['dormitorios'] . "+ dorms., ";
        }

        if (isset($vars['vagas']) && (int)$vars['vagas'] != 0) {
            $caracteristicas .= (int)$vars['vagas'] . "+ vagas, ";
        }

        if (isset($vars['area_minima']) && (int)$vars['area_minima'] != 0) {
            $caracteristicas .= "Mín " . (int)$vars['area_minima'] . "㎡, ";
        }

        if (isset($vars['area_maxima']) && (int)$vars['area_maxima'] != 0) {
            $caracteristicas .= "Máx " . (int)$vars['area_maxima'] . "㎡, ";
        }

        if (isset($vars['valor_minimo']) && (float) $vars['valor_minimo'] != 0) {
            $caracteristicas .= "Mín R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_minimo']) . ", ";
        }
        if (isset($vars['valor_maximo']) && (float) $vars['valor_maximo'] != 0) {
            $caracteristicas .= "Máx R$ " . \App\Http\Components\CHtml::moneyMask($vars['valor_maximo']) . ", ";
        }
        if ($caracteristicas != '') {
            $caracteristicas = substr($caracteristicas, 0, -2);
        }

        return array(
            'title'=>$title,
            'caracteristicas'=>$caracteristicas,
        );

    }

}