<?php
use App\Http\Components\CHtml;
$title = $post->titulo;
?>

@extends('layouts.app')

@section('title', $title)

<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

@section('content')
    <div style="background-color: #345C8C; width: 100%">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li><a href="/blogleardi">Blog</a></li>
                <li class="active">{{ $post->titulo }}</li>
            </ol>
        </div>
    </div>

    <div style="background-color: #E1ECF8; width: 100%; padding-top: 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-9">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-body">

                                    <div class="btn-group-vertical" role="group" style="float:right; margin-top: 2px;">
                                        <a type="button" data-mobile-iframe="true" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ url('blogleardi/'.$post->key) }}&src=sdkpreparse&display=popup" data-href="{{ url('blogleardi/'.$post->key) }}/" class="btn btn-primary fb-share-button fb-xfbml-parse-ignore" style="font-weight: 300; font-size: 18px;"><span class="fa fa-facebook-square"></span></a>
                                        @if ( CHtml::isMobile() )
                                            <a href="whatsapp://send?text={{ url('blogleardi/'.$post->key) }}/" data-action="share/whatsapp/share" type="button" class="btn btn-success" style="font-weight: 300; font-size: 18px;"><span class="fa fa-whatsapp"> </span></a>
                                        @endif
                                    </div>

                                    @push('header')
                                    <meta property="og:image" content="{{ url($post->imagem->arquivo) }}" />
                                    <link rel="image_src" href="/wp-content/uploads/{{ url($post->imagem->arquivo) }}" />
                                    @endpush

                                    <div class="thumbnail" style="max-width: 400px; float: right; margin: 2px 2px 10px 10px;">
                                        <img class="img-responsive" src="/wp-content/uploads/{{ $post->imagem->arquivo }}" />
                                    </div>





                                    <h3 style="margin-top: 10px;">{{ $post->titulo }}</h3>
                                    <div style="padding: 10px; font-size: 16px;">
                                        {!! $post->texto !!}
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Veja tamb&eacute;m:</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="http://www.leardi.com.br/blogleardi/wp-content/uploads/2016/10/Veja-como-se-tornar-um-corretor-de-im%C3%B3veis-e-as-vantagens-da-profiss%C3%A3o.-700x397.jpg" />
                                <div class="caption">
                                    <h3>Veja como se tornar um corretor de imóveis e as vantagens da profissão</h3>
                                    <p>Para ser corretor de imóveis o primeiro passo é obter sua qualificação profissional, pois para poder exercer a profissão você precisa ter um curso que lhe permita obter seu registro profissional no CRECI (Conselho Regional de Corretores de Imóveis).</p>
                                    <p style='text-align: right;'><a href=''>Continuar lendo</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <a style='text-decoration: none;' href='#'>
                                    <img class="img-responsive img-rounded" style="width: 100%" src="http://www.leardi.com.br/blogleardi/wp-content/uploads/2016/10/Veja-porque-agora-%C3%A9-o-momento-de-investir-em-im%C3%B3veis-700x437.jpg" />
                                </a>
                                <div class="caption">
                                    <a style='text-decoration: none;' href=''><h3 style='text-decoration: none;'>Veja porque agora é o momento de investir em imóveis</a></h3>
                                    <a style='text-decoration: none; color: #333;' href=''><p>Agora é o momento mais favorável para obter um investimento bastante lucrativo, pois o mercado imobiliário sofreu varias oscilações, e isso gerou uma baixa nos preços dos imóveis, o que torna o imóvel um excelente investimento para quem pode esperar para vender.</p></a>
                                    <p style='text-align: right;'><a href=''>Continuar lendo</a></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <img class="img-responsive" style="width: 100%" src="http://www.leardi.com.br/blogleardi/wp-content/uploads/2016/09/A-mudan%C3%A7a-no-processo-de-compra-de-im%C3%B3veis-700x459.png" />
                                <div class="caption">
                                    <h3>A mudança no processo de compra de imóveis</h3>
                                    <p>As novas tecnologias digitais geram mudanças de comportamento em todos os setores, cada um a sua maneira. A comercialização e locação de imóveis passa por momentos de mudanças, pois a forma com a qual o cliente busca imóveis vem mudando com muita velocidade e cerca de 80% das compras de imóveis começam com uma pesquisa online.</p>
                                    <p style='text-align: right;'><a href=''>Continuar lendo</a></p>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class='col-lg-3'>

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Receba Novidades</h3>
                        </div>

                        <form class="form-group">


                            <div class="panel-body">

                                <p>Cadastre-se e receba as novidades do mercado imobili&aacute;rio em seu email.</p>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="fLocal">Nome</label>
                                            <input type="text" class="form-control" id="fLocal" placeholder="Nome">

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
                                    <div class="col-xs-12">
                                        <button class="btn btn-warning" style="font-weight: 300; width: 100%;"><span class="fa fa-mail-forward"></span> QUERO RECEBER!</button>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <img class='img-responsive' src='http://www.leardi.com.br/blogleardi/wp-content/uploads/2016/10/Banner_Lateral.png' />
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>





@endsection
