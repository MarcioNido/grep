<?php 
use App\Http\Components\Html;
use App\Site\Foto;

$title = mb_convert_case($filter['tipo_imovel'], MB_CASE_TITLE).' em '. ($filter['regiao'] != null ? $filter['regiao']. ' - ' : '') . $filter['cidade'] . ' - ' . $filter['estado'] . ' - Paulo Roberto Leardi';
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
<div style="background-color: #345C8C; width: 100%">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li class="active">{{ $filter['tipo_negocio'] == 'venda' ? 'Venda' : 'Locação' }}</li>
            <li class="active">{{ $filter['estado'] }}</li>
            <li class="active">{{ $filter['cidade'] }}</li>
            <li class="active">{{ $filter['regiao'] != null ? $filter['regiao'] : 'Todas as Regiões' }}</li>
            <li class="active">{{ title_case($filter['tipo_imovel']) }}</li>
        </ol>
    </div>
</div>
      

<div style="background-color: #6B88AE; width: 100%;">
    <div class="container">

        <div class="row">
            <div class="col-md-9">
                <h3 style="color: #FAFAFA; font-weight: 300;"><b>18.996 </b>Casas &agrave; venda em Brooklin, S&atilde;o Paulo, SP</h3>
            </div>
            <div class="col-md-3" style="text-align: right; padding-right: 40px;">
                <form class="form-inline" style="margin-top: 10px;">
                    <div class="form-group">
                        <?= Html::dropDownList('orderSelect', '', ['Mais Recentes' => 'Mais Recentes', 'Maior Valor' => 'Maior Valor', 'Menor Valor' => 'Menor Valor'], ['class' => 'form-control guru-select']) ?>
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

                <div class="col-lg-9">


                    @foreach($imoveis as $imovel)
                    <!-- linha imovel -->
                    <div class="row">
                        <div class="col-lg-12">
                            
                            <div class="panel">
                                
                                <div class="panel-body" style="padding: 2px;">

                                    <?php 
                                    $foto = Foto::where('imovel_id', $imovel->imovel_id)->first();
                                    if ($foto != null) { 
                                        $arquivo = "http://www.leardi.com.br/imagens/".$foto->arquivo;
                                    } else { 
                                        $arquivo = "";
                                    }
                                    ?>
                                    
                                    <div class="col-md-4 col-sm-12 guru-image-item" style="padding-left: 1px; padding-right: 1px;">
                                        <div class="guru-image-background" style="background-image: url('{{ $arquivo }}')"></div>
                                        <div class="guru-image-wrapper" style='background: transparent;'>
                                            <a href="#"><img src="{{ $arquivo }}" class="img-responsive lazyload" /></a>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-8 col-sm-12">
                                        
                                        <div class="row" style="margin-top: 5px;">
                                            
                                            <!--<div class="col-md-12 guru-special-line">&nbsp;</div>-->
                                            
                                            <div class="col-md-5">
                                                <h3 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">{{ title_case($imovel->tipo_imovel) }}</h3>
                                            </div>
                                            
                                            <div class="col-md-7">
                                                <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 15px;">{{ title_case($imovel->regiao_mercadologica) }}, {{ title_case($imovel->cidade) }}, {{ $imovel->estado }}</h4>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <h7 style="color: #333333; font-weight: 300">Pre&ccedil;o</h7>
                                                <h5 style="margin-top: 0; font-weight: 300">R$ 5.000.000,00</h5>
                                            </div>
                                            <div class="col-sm-3 hidden-xs">
                                                <h7 style="color: #333333; font-weight: 300">IPTU</h7>
                                                <h5 style="margin-top: 0; font-weight: 300">R$ 25.000,00</h5>
                                            </div>
                                            <div class="col-sm-6 hidden-xs">
                                                <h7 style="color: #333333; font-weight: 300">Condom&iacute;nio</h7>
                                                <h5 style="margin-top: 0; font-weight: 300">R$ 5.000,00</h5>
                                            </div>                                          
                                        </div>
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                                <div class="guru-result-text-placeholder">
                                                        <p style="color: #666666; font-weight: 300">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                        dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                        dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                        dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                        dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.
                                                        </p>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-xs-3 col-md-3">
                                                        <h7 style="color: #333333; font-weight: 300">&Aacute;rea (&#13217;)</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">250</h5>                                                        
                                                    </div>
                                                    <div class="col-xs-3 col-md-2">
                                                        <h7 style="color: #333333; font-weight: 300">Dorms.</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">{{ $imovel->dormitorio }}</h5>                                                        
                                                    </div>
                                                    <div class="col-xs-3 col-md-2">
                                                        <h7 style="color: #333333; font-weight: 300">Su&iacute;tes</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">3</h5>                                                        
                                                    </div>
                                                    <div class="col-xs-3 col-md-5">
                                                        <h7 style="color: #333333; font-weight: 300">Vagas</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">4</h5>                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12" style="margin-top: 5px; padding-bottom: 10px;">
                                                <a href="index.php?r=site/detalhe&id=123456" class="btn btn-warning" style="width: 100%; font-weight: 300"><span class="fa fa-search-plus"></span> Detalhes</a>
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
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-offset-1" style="text-align: left;">
                <h3 style="color: #FAFAFA; font-weight: 300">Receba novos im&oacute;veis e atualiza&ccedil;&otilde;es relacionadas &agrave; sua pesquisa direto em sua caixa de e-mail!</h3>
                <h5 style="color: #E7E7E7; font-weight: 300;"></h5>
            </div>

        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1" >
                <h5 style="color: #CCCCCC"><span class="fa fa-check"></span> Comprar</h5>
                <h5 style="color: #CCCCCC"><span class="fa fa-check"></span> Apartamento</h5>
            </div>
            <div class="col-md-5">
                <h5 style="color: #CCCCCC"><span class="fa fa-check"></span> Brooklin, S&atilde;o Paulo, SP</h5>
                <h5 style="color: #CCCCCC"><span class="fa fa-check"></span> 3 Dormit&oacute;rios</h5>

            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-lg-10 col-md-offset-1">
                <button class="btn btn-warning">QUERO RECEBER AS OPORTUNIDADES!</button>
            </div>
        </div>
    </div>

</div>

@endsection

  

