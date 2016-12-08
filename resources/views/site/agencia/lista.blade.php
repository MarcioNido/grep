<?php
use App\Http\Components\Html;
$title = "Agências Paulo Roberto Leardi";
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

            <div class="row" style="padding: 10px 0 5px;">
                <div class="col-md-9">
                    <h4 style="color: #FAFAFA; font-weight: 300;">Nossas Agências</h4>
                </div>
                <div class="col-md-3" style="text-align: right; padding-right: 40px;">
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <div class='input-group'>
                                <input type="text" class="form-control" placeholder="Procurar Ag&ecirc;ncias" />
                                <div class="input-group-btn"><button class='btn btn-primary'><span class="fa fa-search"></span></button></div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
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
                                    <p><b>{{ mb_convert_case($agencia->bairro, MB_CASE_TITLE) }}</b></p>
                                    <p>{{ mb_convert_case($agencia->endereco, MB_CASE_TITLE) }}</p>
                                    <p>({{ $agencia->ddd1 }}) {{ $agencia->telefone1 }} <b>CRECI </b>{{ $agencia->creci }}</p>
                                    <p style='text-align: right;'><a href='index.php?r=blog/page&page=post'>P&aacute;gina da Unidade</a></p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>

                </div>


                <div class='col-lg-3'>

                    <div class='panel panel-default'>
                        <div class='panel-body'>
                            <img class='img-responsive' src='http://www.leardi.com.br/blogleardi/wp-content/uploads/2014/10/Layout_Facebook.png' />
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
