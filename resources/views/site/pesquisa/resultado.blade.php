<?php 
use App\Http\Components\CHtml;
use App\Site\Foto;

/** @var $searchResult \App\Site\ImovelSearch */
$filter = $searchResult['filter'];
$imoveis = $searchResult['imoveis'];
$filter_desc = $searchResult['titles']['filter_desc'];

$title = $searchResult['titles']['title'];
$subtitle = $searchResult['titles']['subtitle'];
$bc = $searchResult['titles']['breadcrumbs'];
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
<div style="background-color: #345C8C; width: 100%">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">{{ $bc['tipo_negocio'] }}</li>
            <li class="active">{{ $bc['estado'] }}</li>
            <li class="active">{{ $bc['cidade'] }}</li>
            <li class="active">{{ $bc['regiao'] }}</li>
            <li class="active">{{ $bc['tipo_imovel'] }}</li>
        </ol>
    </div>
</div>

<div style="background-color: #6B88AE; width: 100%;">
    <div class="container">

        <div class="row">
            <div class="col-md-9">
                <h4 style="color: #FAFAFA; font-weight: 300;">{!! $subtitle !!}</h4>
            </div>
            <div class="col-md-3" style="text-align: right; padding-right: 40px;">
                <form class="form-inline" style="margin-top: 3px;">
                    <div class="form-group">
                        <?= CHtml::dropDownList('orderSelect', $filter['order'], ['Mais Recentes' => 'Mais Recentes', 'Maior Valor' => 'Maior Valor', 'Menor Valor' => 'Menor Valor'], ['class' => 'form-control guru-select', 'onchange' => 'changeOrder()']) ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div style="background-color: #E1ECF8; width: 100%;">
    <div class="container" style="padding-top: 20px;">

        <div  id="ph_toggle_filtro" class="row hidden-lg" style="margin-bottom: 15px;">
                <div class="col-xs-12">
                    <button class="btn btn-primary" style="width: 100%" onclick="$('#ph_filtro').toggleClass('hidden-md hidden-sm hidden-xs');">FILTRAR RESULTADOS</button>
                </div>
        </div>
        
            <div class="row">
                
                <div id="ph_filtro" class="col-lg-3 hidden-md hidden-sm hidden-xs">
                    @include('site.pesquisa.resultado_filtro')
                </div>

                <div class="col-lg-9" id="ph_resultado">

                    @foreach($imoveis as $imovel)
                    <!-- linha imovel -->
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <div class="panel">
                                
                                <div class="panel-body" style="padding: 2px;">

                                    <?php
                                    // @todo remover isso daqui e colocar no controller ou melhor, criar uma classe para as fotos
                                    $foto = Foto::where('imovel_id', $imovel->id)->first();
                                    if ($foto != null) {
                                        $arquivo = "/imagens/".$foto->arquivo;
                                    } else { 
                                        $arquivo = "/images/semfoto.png";
                                    }
                                    ?>
                                    
                                    <div class="col-md-4 col-sm-12 guru-image-item" style="padding-left: 1px; padding-right: 1px;">
                                        <div class="guru-image-wrapper" style='background: transparent;'>
                                            <div class="guru-image-background" <?php if ($arquivo != '/images/semfoto.png') echo 'style="background-image: url(\''. $arquivo .'\')"'; ?>></div>
                                            <a href="/imovel/{{ $imovel->id }}"><img src="{{ $arquivo }}" class="img-responsive guru-image" /></a>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        
                                        <div class="row" style="margin-top: 10px;">
                                            
                                            <!--<div class="col-md-12 guru-special-line">&nbsp;</div>-->
                                            
                                            <div class="col-md-12">
                                                <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">{{ title_case($imovel->tipo_imovel) }} em {{ trim(title_case($imovel->regiao_mercadologica)) }}, {{ title_case($imovel->cidade) }}, {{ $imovel->estado }}</h4>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row" style="margin-top: 10px;">
                                            <div class="col-sm-4">
                                                <h6 style="color: #333333; font-weight: 300" class="guru-label">Pre&ccedil;o</h6>
                                                <h4 style="margin-top: 0; font-weight: 300;">R$ <?= $filter['tipo_negocio'] == 'venda' ? CHtml::moneyMask($imovel->valor_venda) : CHtml::moneyMask($imovel->valor_locacao) ; ?></h4>
                                            </div>
                                            
                                            @if ($imovel->valor_iptu != 0)
                                            <div class="col-sm-4 hidden-xs">
                                                <h6 style="color: #333333; font-weight: 300" class="guru-label">IPTU</h6>
                                                <h4 style="margin-top: 0; font-weight: 300;">R$ <?= CHtml::moneyMask($imovel->valor_iptu) ?></h4>
                                            </div>
                                            @endif
                                            
                                            @if ($imovel->valor_condominio != 0) 
                                            <div class="col-sm-4 hidden-xs">
                                                <h6 style="color: #333333; font-weight: 300" class="guru-label">Condom&iacute;nio</h7>
                                                <h4 style="margin-top: 0; font-weight: 300;">R$ <?= CHtml::moneyMask($imovel->valor_condominio) ?></h4>
                                            </div>                               
                                            @endif
                                            
                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="guru-result-text-placeholder">
                                                        <p style="color: #666666; font-weight: 300"><?= $imovel->texto_promocional ?></p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row" style="text-align: center;">
                                                    <div class="col-xs-3 col-md-3">
                                                        <h6 style="color: #333333; font-weight: 300" class="guru-label">&Aacute;rea (&#13217;)</h6>
                                                        <h4 style="margin-top: 0; font-weight: 300">{{ $imovel->tipo_simplificado == "TERRENO" || $imovel->tipo_simplificado == "RURAL" ? $imovel->area_total_terreno : $imovel->area_util_construida }}</h4>                                                     
                                                    </div>
                                                    
                                                    @if ( $filter['tipo_imovel'] != 'comercial' && $filter['tipo_imovel'] != 'terreno' )
                                                    <div class="col-xs-3 col-md-3">
                                                        <h6 style="color: #333333; font-weight: 300" class="guru-label">Dorms.</h6>
                                                        <h4 style="margin-top: 0; font-weight: 300">{{ $imovel->dormitorio }}</h4>                                                        
                                                    </div>
                                                    <div class="col-xs-3 col-md-3">
                                                        <h6 style="color: #333333; font-weight: 300" class="guru-label">Su&iacute;tes</h6>
                                                        <h4 style="margin-top: 0; font-weight: 300">{{ $imovel->suite }}</h4>                                                     
                                                    </div>
                                                    @endif
                                                    
                                                    @if ($imovel->vaga != 0) 
                                                    <div class="col-xs-3 col-md-3">
                                                        <h6 style="color: #333333; font-weight: 300" class="guru-label">Vagas</h6>
                                                        <h4 style="margin-top: 0; font-weight: 300">{{ $imovel->vaga }}</h4>                                                       
                                                    </div>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12" style="margin-top: 12px;">
                                                <a href="/imovel/{{ $imovel->id }}" class="btn btn-warning" style="width: 100%; font-weight: 300"><span class="fa fa-search-plus"></span> Detalhes</a>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!-- fim linha imovel -->
                    @endforeach
                    
                    
                    {{ $imoveis->links() }}
                    
                    
                </div>
            </div>


    </div>
    
</div>


<div style="background-color: #6B88AE; width: 100%; padding: 40px 0;">
    @include('site.pesquisa.receba_novidades')
</div>

@endsection