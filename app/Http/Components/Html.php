<?php

namespace App\Http\Components;

/**
 * Description of Html
 *
 * @author marcionido
 */
class Html {
    
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
