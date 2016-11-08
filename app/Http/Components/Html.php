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
        $html = '<input type="text" id="'.$name.'" value="'.$value.'" ';
        if ($options) {
            foreach($options as $key => $value) {
                $html.= $key.'="'.$value.'" ';
            }
        }
        $html .= '/>';
        
        return $html;
    }
    
}
