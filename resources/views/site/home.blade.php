<?php
use App\Http\Components\CHtml;
use App\Site\Localidade;
use App\DropDownTool;

$pesquisasPopulares = \Illuminate\Support\Facades\DB::table("web_pesquisas_populares")->get();
$title = "Paulo Roberto Leardi";
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <input type="hidden" id="bannerId" value="2">
    <div id="banner" class="container-fluid" style="background: #ddd url('/images/bannerhomeleardi2.jpg') center no-repeat; height: 490px;">
        <div class="">
            <div class="row" style="height: 100px;">
                <div class="col-lg-12" style="text-align: center;">
                    <h2 style="color: #FFFFFF; display:none;" class="miami">Miami is here.</h2>
                    <h4 style="color: #FAFAFA; display:none;" class="miami">Centenas de imóveis na cidade dos brasileiros nos EUA.</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 guru-home-panel-container" style="">
                    <div class="panel panel-info guru-home-panel" style="">

                        <div class="panel-heading guru-home-panel-heading">Encontre aqui o seu futuro im&oacute;vel</div>

                        <div class="panel-body guru-home-panel-body">
                            <form id="form_home" class="form-group" method="post" action="/pesquisa/digest">
                                
                                {{ csrf_field() }}

                                <div id="ph_pesquisa" class="row">
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-2 col-xs-6 guru-home-search">
                                                <?php echo CHtml::dropDownList('tipo_negocio', $filter['tipo_negocio'], ['venda'=>'Comprar', 'locacao'=>'Alugar'], ['class'=>'form-control guru-select', 'style' => 'width: 100%', 'id' => 'tipo_negocio']); ?>
                                            </div>
                                            <div class="col-md-2 col-xs-6 guru-home-search">
                                                <?php echo CHtml::dropDownList('tipo_imovel', $filter['tipo_imovel'], ['apartamento'=>'Apartamento', 'casa'=>'Casa', 'comercial'=>'Comercial', 'terreno'=>'Terreno', 'flat' => 'Flat', 'rural' => 'Rural'], ['class'=>'form-control guru-select', 'style' => 'width: 100%', 'id' => 'tipo_imovel']); ?>
                                            </div>
                                            <div class="col-md-1 col-xs-3 guru-home-search">
                                                {{ Form::activeDropDownList('', 'estado', $filter['estado'], DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'onchange' => 'trigger_estado()', 'id'=>'estado', 'placeholder'=>'Estado']) }}
                                            </div>
                                            <div class="col-md-3 col-xs-9 guru-home-search">
                                                <span id="ph_codcidade">
                                                    {{ Form::activeDropDownList('', 'codcidade', $filter['codcidade'], DropDownTool::getCidade($filter['estado'], 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codcidade', 'placeholder' => 'Cidade', 'onchange' => 'trigger_codcidade()']) }}
                                                </span>
                                            </div>
                                            <div class="col-md-3 col-xs-12 guru-home-search">
                                                <span id="ph_codbairro">
                                                    {{ Form::activeDropDownList('', 'codbairro[]', 0, DropDownTool::getBairro($filter['codcidade'], 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codbairro', 'placeholder' => 'Região']) }}
                                                </span>
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
                                                {!! CHtml::textInput('imovel_id', "", ['placeholder' => 'Informe a referência do imóvel', 'class' => 'form-control']) !!}
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

                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="/seja-um-franqueado">
                            <img class="img-responsive" src="images/95-anos-tradicao.jpg" />
                        </a>
                        <div class="caption">
                            <a href="/seja-um-franqueado" class="btn btn-warning" style="width: 100%">SEJA UM FRANQUEADO!</a>
                            <p style="margin-top: 15px; color:#286090">Empreenda montando a sua imobiliária e sendo líder mesmo antes de iniciar a operação, baixo investimento com alta rentabilidade, saiba mais.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="/area-restrita/trabalhe-conosco">
                            <img class="img-responsive" src="images/home-trabalhe-conosco.jpg" />
                        </a>
                        <div class="caption">
                            <a class="btn btn-warning" href="/area-restrita/trabalhe-conosco" style="width: 100%">TRABALHE CONOSCO!</a>
                            <p style="margin-top: 15px; color:#286090">Seja um corretor LEARDI, descubra como fazer parte da nossa família e as vantagens.</p>
                        </div>
                    </div>

                </div>



                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="http://miamileardi.com/" target="_blank">
                            <img class="img-responsive" src="images/imoveis-em-miami.jpg" />
                        </a>
                        <div class="caption">
                            <a href="http://miamileardi.com/" target="_blank" class="btn btn-warning" style="width: 100%">IMÓVEIS EM MIAMI</a>
                            <p style="margin-top: 15px; color:#286090">Procurando imóveis em Miami? Encontre aqui os melhores.</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-3">
                    <div class="thumbnail">
                        <a href="/images/Revista.pdf" target="_blank">
                            <img class="img-responsive" src="images/revistas-leardi.jpg" />
                        </a>
                        <div class="caption">
                            <a href="/images/Revista.pdf" target="_blank" class="btn btn-warning" style="width: 100%">REVISTA LEARDI</a>
                            <p style="margin-top: 15px; color:#286090">Baixe já a última edição da Revista Leardi</p>
                        </div>
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
    if ($('#estado').val() == '' || $('#codcidade').val() == '') {
        window.alert('Favor selecionar um estado e cidade ...');
        return false;
    }

    $.ajax('/geturl/'+$('#tipo_negocio').val()+'/'+$('#tipo_imovel').val()+'/'+$('#estado').val()+'/'+$('#codcidade').val()+'/'+$('#codbairro').val())
        .done(function(url) {
            $('#form_home').attr('action', url);
            $('#form_home').submit();
        })
        .fail(function() {
            window.alert('Ocorreu um erro ao processar a requisição');
        });
    
////    var url = '/' + $('#tipo_negocio').val();
////    url = url + '/' + $('#localidade_url').val();
////    url = url + '/' + $('#tipo_imovel').val();
//
//    var url = '/venda/sp/sao-paulo/todas-as-regioes/apartamento';
//
//    $('#form_home').attr('action',  url);
//    $('#form_home').submit();
//
}

function send_form_referencia()
{
    if ($('#imovel_id').val() == "") {
        window.alert('Favor informar a referência do imóvel');
        return false;
    }
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

@if(session('unidade') == null || session('unidade')->banner1 == null)
$(document).ready(function() {
    $('div.form-group').removeClass('form-group');
    window.setInterval(function() {
        var isMiami = $(".miami").is(":visible");
        if (isMiami) {
            $('#banner').css('background-image', "url('/images/bannerhomeleardi2.jpg')");
            $('.miami').hide();
        } else {
            $('#banner').css('background-image', "url('/images/imobiliaria-paulo-roberto-leardi-miami.jpg')");
            $('.miami').show();
        }
    }, 15000)
});
@else
$(document).ready(function() {
    var banner1 = "{{ session('unidade')->banner1 }}";
    var banner2 = "{{ session('unidade')->banner2 }}";
    $('div.form-group').removeClass('form-group');
    $('.miami').hide();

    if (banner2 == "") {
        $('#banner').css('background-image', "url('" + banner1 + "'");
    } else {
        window.setInterval(function() {
            var banner = $("#bannerId").val();
            if (banner == 2) {
                $("#bannerId").val(1);
                $('#banner').css('background-image', "url('" + banner1 + "'");
            } else {
                $("#bannerId").val(2);
                $('#banner').css('background-image', "url('" + banner2 + "'");
            }
        }, 15000)
    }

});
@endif

function trigger_estado()
{
    $.ajax('/dropdown/cidade/'+$('#estado').val())
        .done(function(response) {
            $('#ph_codcidade').html(response)
            $("#codcidade").select2({
                theme: "bootstrap",
                minimumResultsForSearch: 15
            });
            $('div.form-group').removeClass('form-group');
        })
        .fail(function() {
            alert('Ocorreu um erro ao recuperar cidades ...');
        });
}

function trigger_codcidade()
{
    $.ajax('/dropdown/bairro/'+$('#codcidade').val())
        .done(function(response) {
            $('#ph_codbairro').html(response)
            $("#codbairro").select2({
                theme: "bootstrap",
                minimumResultsForSearch: 15
            });
            $('div.form-group').removeClass('form-group');
        })
        .fail(function() {
            alert('Ocorreu um erro ao recuperar bairros ...');
        });
}


</script>
@endpush  