<?php

namespace App\Http\Components;

/**
 * Description of Html
 *
 * @author marcionido
 */
class CHtml
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

    public static function radio($name, $value, $checked=false)
    {
        $html = '<input type="radio" name="'.$name.'" value="'.$value.'"' . ($checked ? ' checked="checked"' : '') . '>';
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
        $value = (float) $value;
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
        
        $text .= ' em '. ($filter['localidade'][0]['regiao'] != null ? mb_convert_case($filter['localidade'][0]['regiao'], MB_CASE_TITLE). ', ' : '') . mb_convert_case($filter['localidade'][0]['cidade'], MB_CASE_TITLE) . ', ' . $filter['localidade'][0]['estado'];
        if (count($filter['localidade']) > 2) {
            $text .= ' e mais ' . (count($filter['localidade']) - 1) . ' Regiões';
        } elseif (count($filter['localidade']) > 1) {
            $text .= ' e mais ' . (count($filter['localidade']) - 1) . ' Região';
        }

        return $text;
        
    }

    public static function a($label, $link, $options=[])
    {
        $html  = "<a href='{$link}'";

        foreach($options as $key => $value) {
            $html .= " {$key}='{$value}'";
        }

        $html .= ">";
        $html .= $label;
        $html .= "</a>";

        return $html;

    }

    public static function isMobile()
    {
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
            return true;
        }
        return false;
    }

    public static function dateUs($date)
    {
        if ($date != null && $date != "") {
            return substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2);
        } else {
            return null;
        }
    }

    public static function dateBr($date)
    {
        return substr($date, 8,2).'/'.substr($date,5,2).'/'.substr($date,0,4);
    }

    public static function phoneRemoveMask($value)
    {
        return preg_replace('/\D/', '', $value);
    }

}
