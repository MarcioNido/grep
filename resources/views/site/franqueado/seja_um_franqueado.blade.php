<?php
use App\Http\Components\CHtml;
$title = "Seja um Franqueado Paulo Roberto Leardi";
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div style="background-color: #E1ECF8; width: 100%; padding-top: 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-9">

                    <div class="row">
                        <div class="col-lg-12">
                            <h3>POR QUE INVESTIR EM FRANQUIAS IMOBILI&Aacute;RIAS?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/90-bilhoes.jpg" />
                                <div class="caption">
                                    <p><b>R$ 90 bilh&otilde;es</b> foi o faturamento do setor em 2013</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/taxa-crescimento.jpg" />
                                <div class="caption">
                                    <p><b>13%</b> foi a taxa de crescimento no mesmo ano</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/deficit-habitacional.jpg" />
                                <div class="caption">
                                    <p><b>6 milhões</b> de residências é o tamanho do déficit habitacional no Brasil</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/imobiliarias-franqueadas.jpg" />
                                <div class="caption">
                                    <p><b>89% das imobiliárias</b> americanas são franqueadas</p>
                                </div>
                            </div>
                        </div>


                    </div>



                    <div class="row">
                        <div class="col-lg-12">
                            <h3>POR QUE ESCOLHER A PAULO ROBERTO LEARDI?</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/95-anos-tradicao.jpg" />
                                <div class="caption">
                                    <p><b>95 anos</b> de tradição no mercado imobiliário</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/2000-unidades-franqueadas.jpg" />
                                <div class="caption">
                                    <p>Serão mais de <b>2.000 unidades franqueadas</b></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/400-mil-imoveis.jpg" />
                                <div class="caption">
                                    <p>Mais de <b>400 mil imóveis</b> cadastrados na base</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="/images/banco-de-dados-compartilhado.jpg" />
                                <div class="caption">
                                    <p>Banco de dados de imóveis compartilhado</p>
                                </div>
                            </div>
                        </div>


                    </div>





                </div>



                <div class="col-lg-3">
                    @include('site.franqueado.franquia_contato')
                </div>




            </div>


        </div>

    </div>



    <div style="background-color: #FFFFFF; width: 100%; padding: 60px 0;">

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/images/metodologia-consolidada.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Metodologia de trabalho consolidada</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/investimento-publicidade-online.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Investimentos em publicidade online</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/site-e-redes-sociais.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Sites e redes sociais com ampla audi&ecirc;ncia</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/revista-80-mil.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Revista com tiragem de mais de 80 mil</h4>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left media-middle">
                            <img class="media-object" src="/images/capacitacao-e-manuais.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Capacitação e manuais de implantação e gestão</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/sistema-de-gestao.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Sistema completo de gestão online</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/universidade-leardi.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Universidade Leardi com mais de <b>90 cursos e tutoriais</b></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="media" style="margin-bottom:30px">
                        <div class="media-left">
                            <img class="media-object" src="/images/abf.jpg" />
                        </div>
                        <div class="media-body">
                            <h4>Associada a ABF</h4>
                        </div>
                    </div>
                </div>

            </div>


        </div>


    </div>


    <div style="background-color: #345C8C; width: 100%; padding: 20px 0;">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3 style="color: #FFFFFF">
                        O QUE OS FRANQUEADOS DIZEM
                    </h3>

                    <p style="color:#E7E7E7; font-weight: 300">"Foi um salto muito grande para os negócios imobiliários na cidade de Jundiaí. Em apenas dois meses de operação, podemos perceber a "força da marca" através do feedback do mercado. Com certeza foi a decisão mais correta." - <b style="color:#FFFFFF;">Leonardo Magatão, Jundiaí</b></p>
                    <p style="color:#E7E7E7; font-weight: 300">"Fiquei encantada com a atenção e o atendimento desde o primeiro contato. Fui a outras franqueadoras, mas elas não se comparam. Sinto-me plenamente assistida e orientada no dia a dia. O sucesso, assim, é consequência." - <b style="color:#FFFFFF;">Maria Tereza Capelo, São Paulo (Santana)</b></p>

                </div>
                <div class="col-sm-4">
                    <h3 style="color: #FFFFFF">
                        OP&Ccedil;&Otilde;ES DE INVESTIMENTO
                    </h3>

                    <p style="color:#E7E7E7; font-weight: 300">Para ser um franqueado Leardi, você não precisa ter experiência no mercado imobiliário. Basta ter o capital mínimo necessário e perfil empreendedor. Transferimos todo o nosso conhecimento e damos todo o suporte para que você tenha um negócio eficiente e lucrativo.</p>
                    <p style="color:#E7E7E7; font-weight: 300">Além de abrir e administrar sua própria unidade, você pode optar por outros modelos de investimento. </p>

                    <h4 style="color:#FFFFFF; font-weight: 300">CONVERTA SUA IMOBILI&Aacute;RIA</h4>
                    <p style="color:#e7e7e7; font-weight: 300">Transforme sua imobiliária em uma franquia e veja seus resultados se multiplicarem com uma marca forte.</p>
                    <h4 style="color:#FFFFFF; font-weight: 300">ATUE COMO DESENVOLVEDOR REGIONAL</h4>
                    <p style="color:#E7E7E7; font-weight: 300">Represente a marca Leardi na sua região, trazendo outros franqueados para a rede e aumente o potencial de retorno.</p>
                    <h4 style="color:#FFFFFF; font-weight: 300">SEJA UM S&Oacute;CIO INVESTIDOR</h4>
                    <p style="color:#E7E7E7; font-weight: 300">Não tem tempo para administrar um negócio? Entre com o capital e nós encontramos um sócio para você.</p>

                </div>

                <div class="col-sm-4">
                    <h3 style="color:#FFFFFF; font-weight: 300;">INVESTIMENTO E RETORNO</h3>
                    <h4 style="color:#FFFFFF; font-weight: 300; margin-bottom: 0;">Taxa de Franquia</h4>
                    <p style="color:#E7E7E7; font-weight: 300;">R$ 40 mil</p>
                    <h4 style="color:#FFFFFF; font-weight: 300; margin-bottom: 0;">Instala&ccedil;&otilde;es</h4>
                    <p style="color:#E7E7E7; font-weight: 300;">R$ 35 mil a R$ 50 mil</p>
                    <h4 style="color:#FFFFFF; font-weight: 300; margin-bottom: 0;">Capital de giro</h4>
                    <p style="color:#E7E7E7; font-weight: 300;">R$ 60 mil</p>
                    <h4 style="color:#FFFFFF; font-weight: 300; margin-bottom: 0;">Faturamento Mensal M&eacute;dio</h4>
                    <p style="color:#E7E7E7; font-weight: 300;">R$ 120 mil</p>
                    <h4 style="color:#FFFFFF; font-weight: 300; margin-bottom: 0;">Retorno do investimento</h4>
                    <p style="color:#E7E7E7; font-weight: 300;">de 18 a 24 meses</p>
                    <br />
                    <p style="color:#CCCCCC">* Estimativa para unidade de 50m&sup2;</p>
                </div>

            </div>
        </div>

    </div>

    <div style="background-color: #6B88AE; width: 100%; padding: 40px 0;">
        @include('blog.public.destaques')
    </div>

@endsection
