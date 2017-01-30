<?php
use App\Http\Components\CHtml;
$title = "Agências Paulo Roberto Leardi";
if (! isset($term)) {
    $term = "";
}
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div style="background-color: #345C8C; width: 100%">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Agências</li>
            </ol>
        </div>
    </div>

    <div style="background-color: #6B88AE; width: 100%;">
        <div class="container">

            <form action="/agencias/search" method="post">
                {{ csrf_field() }}
                <div class="row" style="padding: 10px 0 5px;">
                    <div class="col-md-9">
                        <h4 style="color: #FAFAFA; font-weight: 300;">Nossas Agências</h4>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="width: 100%">
                            <div class='input-group' style="width: 100%">
                                <input name="term" value="{{ $term }}" type="text" class="form-control" placeholder="Procurar Ag&ecirc;ncias" style="width:100%" />
                                <div class="input-group-btn"><button class='btn btn-primary'><span class="fa fa-search"></span></button></div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div style="background-color: #E1ECF8; width: 100%; padding-top: 20px;">
        <div class="container">

            <div class="row">

                <div class="col-lg-9">

                    <div class="row">
                        <?php $i=0; ?>
                        @foreach ($agencias as $agencia)
                            <?php
                                    if ($i++ >= 3) {
                                        $i=1;
                                        echo '</div>';
                                        echo '<div class="row">';
                                    }
                            ?>

                        <div class="col-sm-4">
                            <div class="thumbnail">
                                <div class="guru-image-wrapper" style='background: transparent;'>
                                    <div class="guru-image-background" style="background-image: url('http://www.leardi.com.br/imagens/agencias/{{ $agencia->foto_agencia }}')"></div>
                                    <img class="img-responsive guru-image" style="width: 100%" src="http://www.leardi.com.br/imagens/agencias/{{ $agencia->foto_agencia }}" />
                                </div>
                                <div class="caption">
                                    <h3>Unidade {{ mb_convert_case($agencia->nome, MB_CASE_TITLE) }}</h3>
                                    <p>{{ mb_convert_case($agencia->enderecoCompleto(), MB_CASE_TITLE) }}</p>
                                    <p>{{ mb_convert_case($agencia->cidade, MB_CASE_TITLE) }} - {{ $agencia->estado }}</p>
                                    <p>{{ mb_convert_case($agencia->bairro, MB_CASE_TITLE) }}</p>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            ({{ $agencia->ddd1 }}) {{ $agencia->telefone1 }}
                                        </div>
                                        <div class="col-sm-6">
                                            <b>CRECI </b>{{ $agencia->creci }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>


                <div class='col-lg-3'>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <a href="/area-restrita/ebook">
                                <img class='img-responsive' src='/images/Layout_Facebook.png' />
                            </a>
                        </div>
                    </div>

                    <div class="panel panel-primary">

                        <div class="panel-heading">
                            <h3 class="panel-title">Receba Novidades</h3>
                        </div>

                        <form class="form-group">


                            <div class="panel-body">

                                <p>Cadastre-se e receba as novidades do mercado imobili&aacute;rio em seu email.</p>

                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="/area-restrita/dados-pessoais" class="btn btn-warning" style="font-weight: 300; width: 100%;"><span class="fa fa-mail-forward"></span> QUERO RECEBER!</a>
                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <a href="/area-restrita/ebook-corretor">
                                <img class='img-responsive' src='/images/Capa_Ebook-logo1.png' />
                            </a>
                        </div>
                    </div>


                </div>

            </div>

        </div>

    </div>




@endsection
