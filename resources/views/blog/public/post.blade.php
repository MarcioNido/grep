<?php
use App\Http\Components\CHtml;
$title = $post->titulo;
if ($post->imagem) {
    $arquivo = '/wp-content/uploads/'. $post->imagem->arquivo;
} else {
    $arquivo = "";
}
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
                                    <meta property="og:image" content="{{ url($arquivo) }}" />
                                    <link rel="image_src" href="{{ url($arquivo) }}" />
                                    @endpush

                                    <div class="thumbnail" style="max-width: 400px; float: right; margin: 2px 2px 10px 10px;">
                                        <img class="img-responsive" src="{{ $arquivo }}" />
                                    </div>





                                    <h3 style="margin-top: 10px;">{{ $post->titulo }}</h3>
                                    <div style="padding: 10px; font-size: 16px;">
                                        {!! $post->texto !!}
                                    </div>
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


            <div style="background-color: #6B88AE; width: 100%; padding: 40px 0;">

                @include('blog.public.destaques')

            </div>

        </div>

    </div>





@endsection
