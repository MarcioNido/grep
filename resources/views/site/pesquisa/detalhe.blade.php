<?php
use App\Http\Components\Html;
use App\Site\Foto;

$title = $imovel->title().' - Paulo Roberto Leardi';
?>

@extends('layouts.app')

@push('header')
    <link href="/vendor/lightGallery-master/dist/css/lightgallery.css" rel="stylesheet" />
@endpush


@section('title', $title)

@section('content')

    <div style="background-color: #345C8C; width: 100%">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Detalhes do Imóvel</li>
            </ol>
        </div>
    </div>

    <div style="background-color: #6B88AE; width: 100%;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 style="color: #FAFAFA; font-weight: 300;">{{ $imovel->title() }}</h4>
                </div>

            </div>
        </div>
    </div>


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div style="background-color: #E1ECF8; width: 100%;">
    <div class="container" style="padding-top: 20px;">

            <div class="row">

                <div class="col-lg-9">
                    
                    
                    <div class="row">
                        
                        <div class="col-lg-12">
                            
                            <div class="panel">
                                <div class="panel-body">

                                        <div class="row" style="margin-top: 5px;">
                                            
                                            <!--<div class="col-md-12 guru-special-line">&nbsp;</div>-->
                                            <div class="col-xs-9 col-sm-9 col-md-10 col-lg-11">
                                                
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <h3 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">{{ $imovel->titleCase('tipo_imovel') }}</h3>
                                                    </div>

                                                    <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                                        <h3 style="font-weight: 300; margin-top: 0; margin-bottom: 20px;">{{ trim($imovel->titleCase('regiao_mercadologica')) }}, {{ $imovel->titleCase('cidade') }}, {{ $imovel->estado }}</h3>
                                                    </div>
                                                </div>
                                                


                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        @if ($imovel->valor_venda)
                                                            <h7 style="color: #333333; font-weight: 300">Pre&ccedil;o Venda</h7>
                                                            <h5 style="margin-top: 0; font-weight: 300">R$ {{ $imovel->toCurrency('valor_venda') }}</h5>
                                                        @endif
                                                        @if ($imovel->valor_locacao)
                                                            <h7 style="color: #333333; font-weight: 300">Pre&ccedil;o Locação</h7>
                                                            <h5 style="margin-top: 0; font-weight: 300">R$ {{ $imovel->toCurrency('valor_locacao') }}</h5>
                                                        @endif
                                                    </div>

                                                    @if ($imovel->valor_iptu)
                                                    <div class="col-lg-2 hidden-xs">
                                                        <h7 style="color: #333333; font-weight: 300">IPTU</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">R$ {{ $imovel->toCurrency('valor_iptu') }}</h5>
                                                    </div>
                                                    @endif

                                                    @if ($imovel->valor_condominio)
                                                    <div class="col-lg-2 hidden-xs">
                                                        <h7 style="color: #333333; font-weight: 300">Condom&iacute;nio</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">R$ {{ $imovel->toCurrency('valor_condominio') }}</h5>
                                                    </div>
                                                    @endif

                                                    @if ($imovel->area())
                                                    <div class="col-lg-2 col-md-3">
                                                        <h7 style="color: #333333; font-weight: 300">&Aacute;rea (&#13217;)</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">{{ $imovel->area() }}</h5>
                                                    </div>
                                                    @endif

                                                    @if ($imovel->dormitorio)
                                                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Dorms.</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">{{ $imovel->dormitorio }}</h5>
                                                    </div>
                                                    @endif

                                                    @if ($imovel->suite)
                                                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Su&iacute;tes</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">{{ $imovel->suite }}</h5>
                                                    </div>
                                                    @endif

                                                    @if ($imovel->vaga)
                                                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Vagas</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">{{ $imovel->vaga }}</h5>
                                                    </div>
                                                    @endif

                                                </div>

                                                
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-1" style="text-align: right; margin-top: -5px;">
                                                
                                                <div class="btn-group-vertical" role="group">
                                                    <a type="button" data-mobile-iframe="true" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url('imovel/'.$imovel->id) }}&amp;src=sdkpreparse&display=popup" data-href="http://apps.dev/yii2-app-advanced/frontend/web/index.php?r=site/detalhe&amp;id=123456" class="btn btn-primary fb-share-button fb-xfbml-parse-ignore" style="font-weight: 300; font-size: 18px;"><span class="fa fa-facebook-square"></span></a>
                                                    @if ( Html::isMobile() )
                                                        <a href="whatsapp://send?text={{ url('imovel/'.$imovel->id) }}/" data-action="share/whatsapp/share" type="button" class="btn btn-success" style="font-weight: 300; font-size: 18px;"><span class="fa fa-whatsapp"> </span></a>
                                                    @endif
                                                    <button type="button" class="btn btn-default" style="font-weight: 300; font-size: 18px; color: #286090;"><span class="fa fa-heart"></span></button>
                                                </div>
                                                
<!--<div class="fb-share-button" data-href="http://apps.dev/yii2-app-advanced/frontend/web/index.php?r=site/detalhe&amp;id=123456" data-layout="button" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fapps.dev%2Fyii2-app-advanc1ed%2Ffrontend%2Fweb%2Findex.php%3Fr%3Dsite%252Fdetalhe%26id%3D123456&amp;src=sdkpreparse">Compartilhar</a></div>-->
                                                
                                                <!--<button class="btn btn-primary" style="font-weight: 300;"><span class="fa fa-star"></span> Favorito</button>-->
                                            </div>
                                            
                                        </div>
                                        
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    

                    <div class="row">
                        
                        <div class="col-lg-12">
                            
                            <div id="lightgallery">

                                <div class="row">

                                <?php
                                    // @todo remover isso daqui e colocar no controller ou melhor, criar uma classe para as fotos
                                    //$fotos = Foto::where('imovel_id', $imovel->imovel_id)->orderBy('ordem')->limit(3)->get()
                                    $fotos = $imovel->fotos()->orderBy('ordem')->limit(3)->get();
                                    if ($fotos) {
                                        $first = true;
                                        foreach($fotos as $foto) {

                                            $arquivo = "http://www.leardi.com.br/imagens/".$foto->arquivo;
                                            if ($first) {
                                                ?>
                                                @push('header')
                                                    <meta property="og:image" content="{{ $arquivo }}" />
                                                @endpush
                                                <?php
                                                $first = false;
                                            }

                                ?>
                                            <div class="col-md-4 guru-image-item" data-src="http://www.leardi.com.br/imagens/{{ $foto->arquivo }}">
                                                <div class="thumbnail">
                                                    <div class="guru-image-wrapper">
                                                        <img src="{{ $arquivo }}" alt="foto imóvel" class="img-responsive foto-imovel" />
                                                    </div>
                                                </div>
                                            </div>
                                <?php


                                        }
                                    } else {
                                ?>
                                    <div class="col-md-4 guru-image-item" data-src="/images/imovel7.jpg">
                                        <div class="thumbnail">
                                            <div class="guru-image-wrapper">
                                                <img src="/images/semfoto.jpg" alt="imóvel sem foto" class="img-responsive" />
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>

                                </div>

                            </div>                                
                            

                        </div>
                    </div>         

                    @if ($imovel->texto_promocional)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="color: #666666; font-weight: 300">{{ $imovel->texto_promocional }}</p>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    

                    <div class="row">
                        
                        <div class="col-lg-12">
                            
                            <div id="mapa">

                                <div class="row">
                                    <div class="col-md-12 guru-image-item" data-src="/images/mapa-disabled.png">
                                        <div class="thumbnail" style="height: 160px;">
                                            <div style="background: #ddd url(/images/disabled-map.png) top no-repeat; height: 150px; overflow: hidden">
                                                
                                                <div class="row">
                                                    <div class="col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-8 col-xs-offset-2">
                                                        <div class="well well-sm" style="text-align: center; margin-top: 40px;">
                                                            <h5><span class="fa fa-location-arrow"></span> Clique para Exibir o Mapa</h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>                                
                            

                        </div>
                    </div>         

                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-body">

                                    @if ( $car_unid = $imovel->caracteristicas()->where(['tipo' => 'UNIDADE'])->get() )
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">Caracter&iacute;sticas da Unidade</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="row" style="margin-top: 5px;">
                                         @foreach ( $car_unid as $car )
                                         <div class="col-md-4" >
                                             <h5 style="font-weight: 300; margin-top: 5px; margin-bottom: 5px;"><span class="fa fa-check"></span> {{ title_case($car->descricao) }} </h5>
                                         </div>
                                         @endforeach
                                     </div>

                                     <br>

                                    @endif



                                    @if ( $car_unid = $imovel->caracteristicas()->where(['tipo' => 'CONDOMÍNIO'])->get() )
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">Caracter&iacute;sticas do Condomínio</h4>
                                            </div>
                                        </div>

                                        <div class="row" style="margin-top: 5px;">
                                            @foreach ( $car_unid as $car )
                                                <div class="col-md-4" >
                                                    <h5 style="font-weight: 300; margin-top: 5px; margin-bottom: 5px;"><span class="fa fa-check"></span> {{ title_case($car->descricao) }} </h5>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif



                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
                
                
                
                <div class="col-lg-3">
                    @include('site.pesquisa.detalhe_contato')
                </div>
                
                
                
                
            </div>


    </div>
    
</div>


<div style="background-color: #345C8C; width: 100%; padding: 40px 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-offset-1" style="text-align: left;">
                <h3 style="color: #FAFAFA; font-weight: 300">Receba novos im&oacute;veis e atualiza&ccedil;&otilde;es relacionadas &agrave; sua pesquisa direto em sua caixa de e-mail!</h3>
                <h5 style="color: #E7E7E7; font-weight: 300;"></h5>
            </div>

        </div>
        <div class="row">
            <div class="col-md-5 col-md-offset-1" >
                <h5 style="color: #CCCCCC"><span class="glyphicon glyphicon-check"></span> Comprar</h5>
                <h5 style="color: #CCCCCC"><span class="glyphicon glyphicon-check"></span> Apartamento</h5>
            </div>
            <div class="col-md-5">
                <h5 style="color: #CCCCCC"><span class="glyphicon glyphicon-check"></span> Brooklin, S&atilde;o Paulo, SP</h5>
                <h5 style="color: #CCCCCC"><span class="glyphicon glyphicon-check"></span> 3 Dormit&oacute;rios</h5>

            </div>
        </div>
        <div class="row" style="margin-top: 30px;">
            <div class="col-lg-10 col-md-offset-1">
                <button class="btn btn-warning">QUERO RECEBER AS OPORTUNIDADES!</button>
            </div>
        </div>
    </div>

</div>

<div style="background-color: #E1ECF8; width: 100%; padding: 40px 0;">

    <div class="container">

        <div class="body-content">

            <div class="row">
                <div class="col-lg-12">
                    <h3 style="font-weight: 300;">Veja outros im&oacute;veis parecidos</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="thumbnail">
                        <?= Html::a('<img src="/images/imovel1.jpg" />', '#', ['style'=>'width:100%;']); ?>
                        <div class="caption">
                            <h3>Vila Nova Conceicao</h3>
                            <p><?= Html::a('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. </p>', '/imovel/123456'); ?></p>
                        </div>                            

                    </div>



                </div>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <?= Html::a('<img src="/images/imovel2.jpg" />', '#', ['style'=>'width:100%;']); ?>

                        <div class="caption">
                            <h3>Jardim America</h3>
                            <?= Html::a('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. </p>',  '/imovel/123456'); ?>
                        </div>                            

                    </div>


                </div>
                <div class="col-md-3">
                    <div class="thumbnail">
                        <?= Html::a('<img src="/images/imovel3.jpg" />', '#', ['style'=>'width:100%;']); ?>

                        <div class="caption">
                           <h3>Vila Luzitania</h3>
                           <?= Html::a('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                               dolore magna aliqua. </p>',  '/imovel/123456'); ?>
                       </div>


                    </div>

                </div>
                
                <div class="col-md-3">
                    <div class="thumbnail">
                        <?= Html::a('<img src="/images/imovel1.jpg" />', '#', ['style'=>'width:100%;']); ?>

                        <div class="caption">
                           <h3>Vila Mariana</h3>
                           <?= Html::a('<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                               dolore magna aliqua. </p>',  '/imovel/123456'); ?>
                       </div>


                    </div>

                </div>                

            </div>

        </div>        

    </div>



</div>
@endsection

@push('scripts')
<script src="/vendor/lightGallery-master/dist/js/lightgallery.min.js"></script>
<script language="javascript">
//    $(document).ready(function() {
//        $("#lightgallery").lightGallery({selector: ".guru-image-item"});
//    })
</script>

<script language="javascript">

    $('.foto-imovel').on('click', function() {

        <?php

            $fotos = $imovel->fotos()->orderBy('ordem')->limit(50)->get();
            $arquivos = "";
            if ($fotos != null) {
                foreach($fotos as $foto) {
                    $arquivos .= '{
                        "src": "http://www.leardi.com.br/imagens/'.$foto->arquivo.'",
                        "thumb": "http://www.leardi.com.br/imagens/'.$foto->arquivo.'"
                    },';
                }
            }

            if ($arquivos != "") {
                $arquivos = substr($arquivos, 0, -1);
            }

        ?>

        $(this).lightGallery({
            dynamic: true,
            dynamicEl: [
                    <?= $arquivos ?>
            ]
        })

    });


</script>

@endpush