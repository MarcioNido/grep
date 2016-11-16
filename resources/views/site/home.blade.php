<?php
use App\Http\Components\Html;
use App\Site\Localidade;

//var_dump($profile);
?>

@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="background: #ddd url(images/AdobeStock_103524609_WM.jpeg) top no-repeat; height: 490px;">
        <div class="">
            <div class="row">
                <div class="col-lg-8 guru-home-panel-container" style="">
                    <div class="panel panel-info guru-home-panel" style="">
                        <div class="panel-heading guru-home-panel-heading">Encontre aqui o seu futuro im&oacute;vel</div>
                        <div class="panel-body guru-home-panel-body">
                            <form id="form_home" class="form-group" method="post" action="#">
                                
                                {{ csrf_field() }}
                                
                                <div class="row">

                                    <div class="col-sm-3 col-xs-6 guru-home-search">
                                        <?php echo Html::dropDownList('tipo_negocio', $profile->tipo_negocio, ['venda'=>'Comprar', 'locacao'=>'Alugar'], ['class'=>'form-control guru-select', 'style' => 'width: 100%']); ?>
                                    </div>
                                    
                                    <div class="col-sm-3 col-xs-6 guru-home-search">
                                        <?php echo Html::dropDownList('tipo_imovel', $profile->tipo_imovel, ['apartamento'=>'Apartamento', 'casa'=>'Casa', 'comercial'=>'Comercial', 'terreno'=>'Terreno', 'flat' => 'Flat', 'rural' => 'Rural'], ['class'=>'form-control guru-select', 'style' => 'width: 100%']); ?>
                                    </div>
                                    
                                    <div class="col-sm-5 col-xs-12 guru-home-search">
                                        <?php //echo Html::dropDownList('localidade_id', $profile->localidade_id, Localidade::getList(), ['class'=>'form-control']); ?>
                                        <?php echo Localidade::getDropDown($profile->localidade_url); ?>
                                    </div>
                                    <div class="col-sm-1 col-xs-12 guru-home-search">
                                        <button type="button" class="btn btn-warning guru-home-button" onclick="send_form()"><span class="fa fa-search"></span></button>
                                    </div>
                  
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div style="background-color: #FFFFFF; width: 100%; padding: 40px 0;">
        <div class="container">
            
            <div class="row">
                
                <div class="col-sm-4" style="text-align: right;">
                    <div class="thumbnail">
                        <a href="index.php?r=site/seja-um-franqueado">
                            <img class="img-responsive" src="images/home-seja-um-franqueado.jpg" />
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-8">
                    <a href="index.php?r=site/seja-um-franqueado">
                        <h3>Empreenda montando a sua imobiliária e sendo líder mesmo antes de iniciar a operação, baixo investimento com alta rentabilidade, saiba mais.</h3>
                    </a>
                    <a href="index.php?r=site/seja-um-franqueado" class="btn btn-warning">SEJA UM FRANQUEADO!</a>
               </div>
                
            </div>
            
        </div>
        
    </div>
    
    <div style="background-color: #E1ECF8; width: 100%; padding: 40px 0;">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-8" style="text-align: right;">
                    <h3>Seja um corretor LEARDI, descubra como fazer parte da nossa família e as vantagens.</h3>
                    <button class="btn btn-warning" style="margin-bottom: 20px;">TRABALHE CONOSCO!</button>
                </div>
                <div class="col-sm-4">
                    <div class="thumbnail">
                        <img class="img-responsive" src="images/home-trabalhe-conosco.jpg" />
                    </div>
                </div>
            </div>
            

        </div>
        
    </div>
    
    
    <div style="background-color: #6B88AE; width: 100%; padding: 40px 0;">
        
        <div class="container">
            <div class="row">

                <div class="col-lg-12">

                    <h2 style="color: #FFFFFF;">Blog Leardi</h2>
                    <p style="color: #FAFAFA;">Fique por dentro das novidades do mercado imobiliario e de franquias. Oportunidades, dicas, informacao.</p>

                </div>

            </div>
            
            <div class="row">

                <div class="col-md-4">
                    
                    <div class="thumbnail">
                        <img src="images/blog1.jpg" />
                        <div class="caption">
                            <h3>Dicas para prospectar clientes e vender imóveis nas redes sociais</h3>
                            <p>Prospecção de clientes significa a estratégia utilizada para procurar e conquistar clientes. A maioria dos corretores de imóveis já utilizou a internet com objetivo é procurar, encontrar e conquistar clientes novos através da sua participação nas Redes Sociais.</p>
                            <p><a href="#" class="btn btn-warning" role="button">Continuar Lendo</a></p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="thumbnail">
                        <img src="images/blog2.jpg" />
                        <div class="caption">
                            <h3>10 dicas para tirar boas fotos de imóveis em Goiás</h3>
                            <p>Existem diversos itens que podem ajudar a potencializar a venda de imóveis em Goiás e em outras cidades. Uma das formas de se destacar é utilizar a internet e todo seu potencial para atrair pessoas interessadas em comprar empreendimentos. Anúncios otimizados costumam trazer melhores resultados e um item importante é a galeria de imagens da casa ou apartamento à venda.</p>
                            <p><a href="#" class="btn btn-warning" role="button">Continuar Lendo</a></p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="col-md-4">
                    
                    <div class="thumbnail">
                        <img src="images/blog3.jpg" />
                        <div class="caption">
                            <h3>O cliente mudou!! – Dicas para ofertar imóveis</h3>
                            <p>As técnicas de ofertar imóveis não são tão eficazes como costumavam ser. Por isso Separamos algumas novas dicas para você colocar mais inteligência em seus processos de vendas.</p>
                            <p><a href="#" class="btn btn-warning" role="button">Continuar Lendo</a></p>
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </div>
        
    </div>

    <div style="background-color: #FFFFFF; width: 100%; padding: 20px 0 40px;">
        
        <div class="container" style="text-align: left;">
            
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="color: #286090">Pesquisas mais populares</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento a Venda no Morumbi</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento para Alugar no Brooklin</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Casa a Venda em Brasilia</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento a Venda em Aruja</a></h6>
                </div>
                <div class="col-md-4">
                    <h6 style="color: #286090"><a style="color: #286090">Terreno a Venda em Indaiatuba</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Casa a Venda em Cidade Jardim</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Imovel Comercial para Alugar na Paulista</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Flat para Alugar no Jardim America</a></h6>
                </div>
                <div class="col-md-4">
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento a Venda no Morumbi</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento para Alugar no Brooklin</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Casa a Venda em Brasilia</a></h6>
                    <h6 style="color: #286090"><a style="color: #286090">Apartamento a Venda em Aruja</a></h6>
                </div>
            </div>
            
            <br />
            
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="color: #286090">Redes Sociais</h3>
                </div>
            </div>
            
            <div class="row" style="text-align: center;">
                <div class="col-xs-3">
                    <h1><a href="#" style="color: #286090"><span class="fa fa-facebook-square"></span></a></h1>
                    <h5 style="color: #286090">Facebook</h5>
                </div>
                <div class="col-xs-3">
                    <h1><a href="#" style="color: #286090"><span class="fa fa-rss-square"></span></a></h1>
                    <h5 style="color: #286090">Blog</h5>
                </div>                
                <div class="col-xs-3">
                    <h1><a href="#" style="color: #286090"><span class="fa fa-youtube-square"></span></a></h1>
                    <h5 style="color: #286090">Youtube</h5>
                </div>   
                <div class="col-xs-3">
                    <h1><a href="#" style="color: #286090"><span class="fa fa-linkedin-square"></span></a></h1>
                    <h5 style="color: #286090">LinkedIn</h5>
                </div>                
                
            </div>
        
            
            
            
        </div>
        
        
        
    </div> 

@endsection

@push('scripts')
<script language='javascript'>

function send_form()
{
    
    if ($('#localidade_url').val() == '') {
        window.alert('Favor selecionar uma localidade ...');
        return false;
    }
    
    var url = '/' + $('#tipo_negocio').val();
    url = url + '/' + $('#localidade_url').val();
    url = url + '/' + $('#tipo_imovel').val();
    
    $('#form_home').attr('action',  url);
    $('#form_home').submit();
    
}
</script>
@endpush  