<?php

namespace App\Site;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    // table name
    protected $table = "web_imovel";

    public function fotos()
    {
        return $this->hasMany('App\Site\Foto');
    }

    public function caracteristicas()
    {
        return $this->belongsToMany('App\Site\Caracteristica', 'web_imovel_caracteristica', 'imovel_id', 'caracteristica_id');
    }

    /**
     * Title of the property
     * @return mixed|string
     */
    public function title()
    {
        $title = mb_convert_case($this->tipo_imovel, MB_CASE_TITLE);
        if ($this->disponivel_venda == 1 && $this->disponivel_locacao == 1) {
            $title .= " para Venda ou Locação";
        } elseif ($this->disponivel_venda == 1) {
            $title .= " à Venda";
        } else {
            $title .= " para Locação";
        }

        $title .= " em ".mb_convert_case($this->regiao_mercadologica, MB_CASE_TITLE);
        $title .= ", ".mb_convert_case($this->cidade, MB_CASE_TITLE);
        $title .= ", ".$this->estado;

        return $title;

    }

    /**
     * Converts $field to TitleCase style
     * @param $field
     * @return mixed|string
     */
    public function titleCase($field)
    {
        return mb_convert_case($this->$field, MB_CASE_TITLE);
    }

    public function toCurrency($field)
    {
        return number_format($this->$field, 2, ',', '.');
    }

    public function preco()
    {
        if ($this->disponivel_venda && $this->disponivel_locacao) {
            $preco = "Venda R$ ".number_format($this->valor_venda, 2, ',', '.');
            $preco .= "<br>Locação R$ ".number_format($this->valor_locacao, 2, ',', '.');
        } elseif ($this->disponivel_venda) {
            $preco = "R$ ".number_format($this->valor_venda, 2, ',', '.');
        } else {
            $preco = "R$ ".number_format($this->valor_locacao, 2, ',', '.');
        }
        return $preco;
    }

    public function area()
    {
        if ($this->area_util_construida) {
            return $this->area_util_construida;
        }
        if ($this->area_total_terreno) {
            return $this->area_total_terreno;
        }

        return false;

    }

    public function caracteristicasUnidade()
    {
        $car = array();
        if ($this->car_unidade) {
            $car_unidade = explode("/", $this->car_unidade);
            if ($car_unidade) {
                foreach($car_unidade as $car_id) {

                }
            }
        }
    }

}
