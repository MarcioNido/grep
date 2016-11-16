<?php

namespace App\Http\Components;

/**
 * Description of Html
 *
 * @author marcionido
 */
class Html 
{
    

    public static function dropDownList($name, $defaultValue, $data, $options) 
    {
            $html  = "<select name = '{$name}' id='{$name}'";
            
            foreach($options as $key => $value) {
                $html .= " {$key}='{$value}'";
            }
            $html .= ">";
            
            foreach($data as $key => $value) {
                $html .= "<option value='{$key}'";
                $html .= ($key == $defaultValue ? ' selected="selected"': '');
                $html .= ">{$value}</option>";
            }
            $html .= "</select>";
            
            
            return $html;
        
    }
    
    public static function textInput($name, $value='', $options=[])
    {
        $html = '<input type="text" id="'.$name.'" name="' .$name. '" value="'.$value.'" ';
        if ($options) {
            foreach($options as $key => $value) {
                $html.= $key.'="'.$value.'" ';
            }
        }
        $html .= '/>';
        
        return $html;
    }
    
    public static function removeMask($value)
    {
            $value = str_replace(",", ".", str_replace(".", "", $value));
            if($value > 0) {
                    return $value;
            } else {
                    return 0;
            }
        
    }
    
    public static function moneyMask($value, $decimals=2)
    {
         if (is_numeric($value)) { 
            if ($value == "") {
                $value = 0;
            }
            $value = number_format($value, $decimals, ",", ".");
         } 
         return $value;
    }
    
    // $title = mb_convert_case($filter['tipo_imovel'], MB_CASE_TITLE).' em '. ($filter['regiao'] != null ? $filter['regiao']. ' - ' : '') . $filter['cidade'] . ' - ' . $filter['estado'] . ' - Paulo Roberto Leardi';

    public static function subtitle($quant, $filter)
    {
        
        $plural = [
            'apartamento' => 'Apartamentos',
            'casa' => 'Casas',
            'comercial' => 'Imóveis Comerciais',
            'rural' => 'Propriedades Rurais',
            'terreno' => 'Terrenos',
            'flat' => 'Flats',
        ];
        
        $text  = "<b>".$quant . "</b> ";
        
        $text .= $plural[$filter['tipo_imovel']];
        if ($filter['tipo_negocio'] == 'venda') {
            $text .= ' à Venda';
        } else { 
            $text .= " para Alugar";
        }
        
        $text .= ' em '. ($filter['regiao'] != null ? mb_convert_case($filter['regiao'], MB_CASE_TITLE). ', ' : '') . mb_convert_case($filter['cidade'], MB_CASE_TITLE) . ', ' . $filter['estado'];

        return $text;
        
    }
    
    
    
}
