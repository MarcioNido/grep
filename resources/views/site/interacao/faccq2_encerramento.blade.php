<?php
use App\DropDownTool;
$title = "Paulo Roberto Leardi";
$breadcrumbs = [
    'Home' => url('/'),
    'Pesquisa de Satisfação'=>'',
];
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <h1>Pesquisa de Satisfação</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br />
                <h5><b>
                        <?php if ($model->encerramento != 'DESISTIU NEGOCIO') { ?>
                        Obrigado pela informação. Sua resposta já está registrada.<br />
                        Se possível, responda apenas mais esta questão abaixo e fique à vontade para fazer mais algum comentário se desejar.
                        <?php } else { ?>
                        Obrigado pela informação. Sua resposta já está registrada.<br />
                        Fique à vontade para fazer mais algum comentário se desejar.
                        <?php } ?>
                    </b></h5>

                        <form method="post">
                            {{ csrf_field() }}

                            @if( $model->encerramento == 'FECHOU NEGOCIO')
                                <div class="row" style="margin-top: 35px;">
                                    <div class="col-md-6">
                                        {{ Form::activeDropDownList('Como foi realizado o fechamento do negócio?', 'encerramento_detalhe', $model->encerramento_detalhe,  array('FECHOU LEARDI' => 'Fechou negócio com a LEARDI', 'FECHOU IMOBILIARIA' => 'Fechou negócio com outra imobiliária', 'FECHOU CORRETOR' => 'Fechou negócio com corretor independente', 'FECHOU PROPRIETARIO' => 'Fechou direto com o proprietário'), array('class'=>'form-control guru-select', 'placeholder'=>'...')) }}
                                    </div>
                                </div>
                            @endif

                            @if( $model->encerramento == 'CONTINUA PROCURANDO')
                                <div class="row" style="margin-top: 35px;">
                                    <div class="col-md-6">
                                        {{ Form::activeDropDownList('Como gostaria de continuar o seu atendimento?', 'encerramento_detalhe', $model->encerramento_detalhe, array('MESMO PROFISSIONAL'=>'Continuar com o mesmo profissional', 'OUTRO PROFISSIONAL'=>'Ser atendido por outro profissional'), array('class'=>'form-control guru-select', 'placeholder'=>'...')) }}
                                    </div>
                                </div>
                            @endif

                            <div class="row" style="margin-top: 35px;">
                                <div class="col-md-12">
                                    <label>Gostaria de fazer algum comentário? Faça à vontade no campo abaixo, após terminar clique no botão ENVIAR.</label>
                                    {{ Form::activeTextArea('', 'comentario', $model->comentario) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12" style="text-align: right;">
                                    <input type="submit" value="ENVIAR" class="btn btn-warning">
                                </div>
                            </div>

                        </form>


            </div>

        </div>
    </div>

@endsection