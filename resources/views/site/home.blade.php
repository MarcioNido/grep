<?php
use App\Http\Components\CHtml;
use App\Site\Localidade;

$pesquisasPopulares = \Illuminate\Support\Facades\DB::table("web_pesquisas_populares")->get();
?>

@extends('layouts.app')

@section('content')

    <div class="container-fluid" style="background: #ddd url('/images/bannerhomeleardi2.jpg') center no-repeat; height: 490px;">
        <div class="">
            <div class="row">
                <div class="col-lg-8 guru-home-panel-container" style="">
                    <div class="panel panel-info guru-home-panel" style="">

                        <div class="panel-heading guru-home-panel-heading">Encontre aqui o seu futuro im&oacute;vel</div>

                        <div class="panel-body guru-home-panel-body">
                            <form id="form_home" class="form-group" method="post" action="#">
                                
                                {{ csrf_field() }}

                                <div id="ph_pesquisa" class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-3 col-xs-6 guru-home-search">
                                                <?php echo CHtml::dropDownList('tipo_negocio', $filter['tipo_negocio'], ['venda'=>'Comprar', 'locacao'=>'Alugar'], ['class'=>'form-control guru-select', 'style' => 'width: 100%']); ?>
                                            </div>
                                            <div class="col-sm-3 col-xs-6 guru-home-search">
                                                <?php echo CHtml::dropDownList('tipo_imovel', $filter['tipo_imovel'], ['apartamento'=>'Apartamento', 'casa'=>'Casa', 'comercial'=>'Comercial', 'terreno'=>'Terreno', 'flat' => 'Flat', 'rural' => 'Rural'], ['class'=>'form-control guru-select', 'style' => 'width: 100%']); ?>
                                            </div>
                                            <div class="col-sm-5 col-xs-12 guru-home-search">
                                                <?php //echo Html::dropDownList('localidade_id', $profile->localidade_id, Localidade::getList(), ['class'=>'form-control']); ?>
                                                <?php echo Localidade::getDropDown($filter['localidade_url'][0]); ?>
                                            </div>
                                            <div class="col-sm-1 col-xs-12 guru-home-search">
                                                <button id="bot_pesquisa" type="button" class="btn btn-warning guru-home-button" onclick="send_form()"><span class="fa fa-search"></span></button>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px;">
                                            <div class="col-sm-12 guru-home-search">
                                                <button id="bot_ref" type="button" class="btn btnprimary guru-home-button" onclick="trigger_referencia()">Pesquisar pela Referência do Imóvel</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div id="ph_referencia" class="row" style="display:none;">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-11 guru-home-search">
                                                {!! CHtml::textInput('referencia', "", ['placeholder' => 'Informe uma ou mais referências de imóveis separadas por vírgulas', 'class' => 'form-control']) !!}
                                            </div>
                                            <div class="col-sm-1 col-xs-12 guru-home-search">
                                                <button id="bot_pesquisa" type="button" class="btn btn-warning guru-home-button" onclick="send_form_referencia()"><span class="fa fa-search"></span></button>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 5px;">
                                            <div class="col-sm-12 guru-home-search">
                                                <button id="bot_ref" type="button" class="btn btnprimary guru-home-button" onclick="trigger_pesquisa()">Pesquisar pelas Características do Imóvel</button>
                                            </div>
                                        </div>
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
                        <a href="/seja-um-franqueado">
                            <img class="img-responsive" src="images/home-seja-um-franqueado.jpg" />
                        </a>
                    </div>
                </div>
                
                <div class="col-sm-8">
                    <a href="/seja-um-franqueado">
                        <h3>Empreenda montando a sua imobiliária e sendo líder mesmo antes de iniciar a operação, baixo investimento com alta rentabilidade, saiba mais.</h3>
                    </a>
                    <a href="/seja-um-franqueado" class="btn btn-warning">SEJA UM FRANQUEADO!</a>
               </div>
                
            </div>
            
        </div>
        
    </div>
    
    <div style="background-color: #E1ECF8; width: 100%; padding: 40px 0;">
        <div class="container">
            
            <div class="row">
                <div class="col-sm-8" style="text-align: right;">
                    <h3>Seja um corretor LEARDI, descubra como fazer parte da nossa família e as vantagens.</h3>
                    <a class="btn btn-warning" href="/area-restrita/trabalhe-conosco" style="margin-bottom: 20px;">TRABALHE CONOSCO!</a>
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

        @include('blog.public.destaques')
        
    </div>

    <div style="background-color: #FFFFFF; width: 100%; padding: 20px 0 40px;">
        
        <div class="container" style="text-align: left;">
            
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="color: #286090">Pesquisas mais populares</h3>
                </div>
            </div>
            
            <div class="row">
                @foreach ($pesquisasPopulares as $pesquisaPopular)
                <div class="col-md-4">
                    <h6 style="color: #286090"><a style="color: #286090" href="{{ $pesquisaPopular->url }}">{{ $pesquisaPopular->descricao }}</a></h6>
                </div>
                @endforeach
            </div>
            
            <br />
            
            <div class="row">
                <div class="col-lg-12">
                    <h3 style="color: #286090">Redes Sociais</h3>
                </div>
            </div>
            
            <div class="row" style="text-align: center;">
                <div class="col-xs-3">
                    <h1><a href="https://facebook.com/PauloRobertoLeardi" target="_blank" style="color: #286090"><span class="fa fa-facebook-square"></span></a></h1>
                    <h5 style="color: #286090">Facebook</h5>
                </div>
                <div class="col-xs-3">
                    <h1><a href="/blogleardi" style="color: #286090"><span class="fa fa-rss-square"></span></a></h1>
                    <h5 style="color: #286090">Blog</h5>
                </div>                
                <div class="col-xs-3">
                    <h1><a href="https://www.youtube.com/user/imobiliarialeardi" target="_blank" style="color: #286090"><span class="fa fa-youtube-square"></span></a></h1>
                    <h5 style="color: #286090">Youtube</h5>
                </div>   
                <div class="col-xs-3">
                    <h1><a href="https://br.linkedin.com/in/leardi" target="_blank" style="color: #286090"><span class="fa fa-linkedin-square"></span></a></h1>
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

function send_form_referencia()
{
    $('#form_home').attr('action', '/pesquisa/referencia');
    $('#form_home').submit();
}

function trigger_referencia()
{
    $('#ph_pesquisa').slideUp('fast');
    $('#ph_referencia').slideDown('fast');
}

function trigger_pesquisa()
{
    $('#ph_referencia').slideUp('fast');
    $('#ph_pesquisa').slideDown('fast');
}

</script>
@endpush  