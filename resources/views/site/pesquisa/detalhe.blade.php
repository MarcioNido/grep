<?php
use App\Http\Components\Html;
use App\Site\Foto;

$title = 'Detalhes do Imóvel - Paulo Roberto Leardi';
?>

@extends('layouts.app')

@section('header')
    <link href="/vendor/lightGallery-master/dist/css/lightgallery.css" rel="stylesheet" />
@endsection


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
                    <h4 style="color: #FAFAFA; font-weight: 300;">Casa &agrave; venda em Brooklin, S&atilde;o Paulo, SP, com 3 Dormit&oacute;rios</h4>
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
                                                        <h3 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">Casa T&eacute;rrea</h3>
                                                    </div>

                                                    <div class="col-lg-9 col-md-6 col-sm-6 col-xs-12">
                                                        <h3 style="font-weight: 300; margin-top: 0; margin-bottom: 20px;">Brooklin, S&atilde;o Paulo, SP</h3>
                                                    </div>
                                                </div>
                                                


                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <h7 style="color: #333333; font-weight: 300">Pre&ccedil;o (R$)</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">5.000.000,00</h5>
                                                    </div>
                                                    <div class="col-lg-2 hidden-xs">
                                                        <h7 style="color: #333333; font-weight: 300">IPTU</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">R$ 25.000,00</h5>
                                                    </div>
                                                    <div class="col-lg-2 hidden-xs">
                                                        <h7 style="color: #333333; font-weight: 300">Condom&iacute;nio</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">R$ 5.000,00</h5>
                                                    </div>       
                                                    <div class="col-lg-2 col-md-3">
                                                        <h7 style="color: #333333; font-weight: 300">&Aacute;rea (&#13217;)</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">250</h5>                                                        
                                                    </div>
                                                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Dorms.</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">4</h5>                                                        
                                                    </div>
                                                    <div class="col-lg-1 col-md-2 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Su&iacute;tes</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">3</h5>                                                        
                                                    </div>
                                                    <div class="col-lg-2 col-md-5 col-sm-3 col-xs-3">
                                                        <h7 style="color: #333333; font-weight: 300">Vagas</h7>
                                                        <h5 style="margin-top: 0; font-weight: 300">4</h5>                                                        
                                                    </div>                                            
                                                </div>

                                                
                                                
                                                
                                                
                                            </div>
                                            
                                            
                                            <div class="col-xs-3 col-sm-3 col-md-2 col-lg-1" style="text-align: right; margin-top: -5px;">
                                                
                                                <div class="btn-group-vertical" role="group">
                                                    <a type="button" data-mobile-iframe="true" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fapps.dev%2Fyii2-app-advanced%2Ffrontend%2Fweb%2Findex.php%3Fr%3Dsite%252Fdetalhe%26id%3D123456&amp;src=sdkpreparse&display=popup" data-href="http://apps.dev/yii2-app-advanced/frontend/web/index.php?r=site/detalhe&amp;id=123456" class="btn btn-primary fb-share-button fb-xfbml-parse-ignore" style="font-weight: 300; font-size: 18px;"><span class="fa fa-facebook-square"></span></a>
                                                    <button type="button" class="btn btn-success" style="font-weight: 300; font-size: 18px;"><span class="fa fa-whatsapp"> </span></button>
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
                                    $fotos = Foto::where('imovel_id', $imovel->imovel_id)->orderBy('ordem')->limit(3)->get();
                                    if ($fotos != null) {
                                        foreach($fotos as $foto) {
                                            $arquivo = "http://www.leardi.com.br/imagens/".$foto->arquivo;
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
                    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel">
                                <div class="panel-body">
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <p style="color: #666666; font-weight: 300">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                                dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                                                dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et.</p>

                                            
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    

                    <div class="row">
                        
                        <div class="col-lg-12">
                            
                            <div id="mapa">

                                <div class="row">
                                    <div class="col-md-12 guru-image-item" data-src="/images/mapa-disabled.png">
                                        <div class="thumbnail" style="height: 160px;">
                                            <div style="background: #ddd url(images/disabled-map.png) top no-repeat; height: 150px; overflow: hidden">
                                                
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

                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">Caracter&iacute;sticas da Unidade</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                         <div class="col-md-4" >
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Terra&ccedil;o Gourmet</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Arm&aacute;rios Cozinha</h5>
                                         </div>
                                         <div class="col-md-4">
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Arm&aacute;rios Embutidos</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Closet</h5>

                                         </div>
                                        <div class="col-md-4">
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Arm&aacute;rios Embutidos</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Closet</h5>
                                        </div>
                                     </div>
                                    


                                    <div class="row" style="margin-top: 40px;">
                                        <div class="col-lg-12">
                                            <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0;">Caracter&iacute;sticas do Condom&iacute;nio</h4>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                         <div class="col-md-4" >
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Piscina Coberta</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Fitness</h5>
                                         </div>
                                         <div class="col-md-4">
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Churrasqueira</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Playground</h5>

                                         </div>
                                        <div class="col-md-4">
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Pet Care</h5>
                                             <h5 style="font-weight: 300;"><span class="glyphicon glyphicon-check"></span> Sal&atilde; de Festas</h5>
                                        </div>
                                     </div>
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    
                </div>
                
                
                
                <div class="col-lg-3">

                    <div class="panel panel-primary">
                        
                        <div class="panel-heading">
                            <h3 class="panel-title">Entre em Contato</h3>
                        </div>
                        
                        <form class="form-group">
                            

                            <div class="panel-body" style="background-color: #FFFFFF;">
                                <div class="row">
                                    <div class="col-xs-12">

                                        <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0; color: #666666;">Unidade </h4>
                                        <h3 style="font-weight: 300; margin-top: 0;">Groenl&acirc;ndia</h3>
                                        
                                        <button class="btn btn-primary" style="font-weight: 300; width: 100%;"><span class="fa fa-phone"></span> VER TELEFONE</button>

                                    </div>

                                </div>
                            </div>                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fLocal">Nome</label>
                                            <input type="text" class="form-control" id="fLocal" placeholder="Nome">
                                            
                                        </div>


                                    </div>   
                                </div>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="fLocal">DDD</label>
                                            <input type="text" class="form-control" id="fLocal" placeholder="DDD">
                                        </div>
                                    </div>
                                    <div class="col-xs-9">
                                        <div class="form-group">
                                            <label for="fLocal">Telefone</label>
                                            <input type="text" class="form-control" id="fLocal" placeholder="Telefone">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fLocal">Email</label>
                                            <input type="email" class="form-control" id="fLocal" placeholder="Email">
                                            
                                        </div>


                                    </div>   
                                </div>       
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fLocal">Observa&ccedil;&otilde;es</label>
                                            <textarea class="form-control">Gostaria de mais informações sobre este imóvel.</textarea>                                            
                                        </div>
                                    </div>   
                                </div>      
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" />
                                                Gostaria de receber ofertas de im&oacute;veis similares por e-mail
                                            </label>
                                                                           
                                        </div>
                                    </div>   
                                </div>      
                                
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button class="btn btn-warning" style="font-weight: 300; width: 100%;"><span class="fa fa-mail-forward"></span> ENVIAR MENSAGEM</button>                                    
                                    </div>
                                </div>

                            </div>
                            
                        </form>

                    </div>
                    
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
            $fotos = Foto::where('imovel_id', $imovel->imovel_id)->orderBy('ordem')->limit(50)->get();
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
