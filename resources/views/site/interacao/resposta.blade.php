<?php
use App\DropDownTool;
$title = "Paulo Roberto Leardi";
$breadcrumbs = [
    'Home' => url('/'),
    'CRM' => '',
];
$emailPart = \App\Bdi\MktEmailPart::where('email_part_id', $model->resposta)->first();

?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="painelresultado">

        <div class="row">
            <div class="medium-12 columns">
                <br/>
                <h5>
                    <?php echo str_replace("\n", "<br>", $emailPart['botao_texto']); ?>
                </h5>

                <?php if ($emailPart->botao_comentario == 'SIM') { ?>

                <form method="post">
                    {{ csrf_field() }}


                    <div class="row" style="margin-top: 35px;">
                        <div class="medium-12 columns">
                            <h6>Gostaria de fazer algum comentário? Faça à vontade no campo abaixo, após terminar clique
                                no botão ENVIAR.</h6>
                            {{ Form::activeTextArea('', 'comentario', $model->comentario) }}
                        </div>
                    </div>

                    <div class="row">
                        <div class="medium-12 columns" style="text-align: right;">
                            <input type="submit" value="ENVIAR" class="btn btn-warning">
                        </div>
                    </div>

                </form>

                <?php } ?>

            </div>

        </div>


    </div>
