<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Localidade extends Model
{
    public $timestamps=false;
    protected $fillable = ['nome', 'descricao', 'localidade_url', 'cidade', 'tipo', 'estado', 'regiao'];
    
    public static function getList() 
    {
        return self::where('active', 1)->orderBy('descricao')->pluck('descricao', 'url');
    }
    
    public static function getDropDown($selectedValue='')
    {
        
          $html  = "<select name='localidade_url' id='localidade_url' class='form-control guru-select filtro' data-placeholder='Selecione uma cidade ou região ...' data-allow-clear='true' style='width:100%'>";
          $html .= "<option></option>";
          // pega as cidades 
          $cidades = self::where('tipo', 1)->orderBy('estado')->orderBy('cidade')->get();
          
          $html .= "<optgroup label='Cidades'>";
          
          foreach($cidades as $cidade) {
                $html .= "<option value='{$cidade->localidade_url}'";
                if ($cidade->localidade_url == $selectedValue) {
                    $html .= " selected='selected' ";
                }
                $html .= ">{$cidade->cidade} - {$cidade->estado}</option>";              
          }
          
          $html .= "</optgroup>";
          
          
          $regioes = self::where('tipo', 2)->orderBy('estado')->orderBy('cidade')->orderBy('regiao')->get();
          $cidade = '';
          
          foreach($regioes as $regiao) {
              
                if ($regiao->cidade." - ".$regiao->estado != $cidade) {
                    if ($cidade != '') {
                        $html .= "</optgroup>";
                    }
                    $html .= "<optgroup label='{$regiao->cidade} - {$regiao->estado}'>";
                    $cidade = $regiao->cidade." - ".$regiao->estado;
                }

                $html .= "<option value='{$regiao->localidade_url}'";
                if ($regiao->localidade_url == $selectedValue) {
                    $html .= " selected='selected' ";
                }                
                $html .= ">{$regiao->regiao}</option>";
          }          
          
          $html .= "</optgroup>";     
          
          $html .= "</select>";
          
          return $html;
          
        
    }
    
}
