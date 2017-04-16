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
                <?php if ($model->resposta == 'SEM RETORNO') { ?>
                    <h5>
                        Pedimos desculpas pelo ocorrido. Os gestores responsáveis pelo seu atendimento foram comunicados.<br />
                        Tomaremos as devidas providências para melhorar nosso atendimento.
                    </h5>
                <?php } else { ?>
                    <h5>
                        Obrigado pela informação. Sua opinião já está registrada.<br />
                        Se possível, responda apenas mais estas 3 questões abaixo e fique à vontade para fazer mais algum comentário se desejar.
                    </h5>

                        <form method="post">
                            {{ csrf_field() }}

                        <div class="row" style="margin-top: 35px;">
                            <div class="col-md-5">
                                <label>Possui visita agendada a imóveis com o corretor LEARDI ?</label>
                            </div>
                            <div class="col-md-2">
                                {{ Form::activeDropDownList('', 'agendamento', $model->agendamento, DropDownTool::getSimNaoBoolean(), array('class'=>'form-control guru-select', 'placeholder'=>'...')) }}
                            </div>
                            <div class="col-md-5">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label>Já visitou algum imóvel com o corretor LEARDI ?</label>
                            </div>
                            <div class="col-md-2">
                                {{ Form::activeDropDownList('', 'visita_leardi', $model->visita_leardi, DropDownTool::getSimNaoBoolean(), array('class'=>'form-control guru-select', 'placeholder'=>'...')) }}
                            </div>
                            <div class="col-md-5">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <label>Já visitou algum imóvel com corretores de OUTRAS imobiliárias ?</label>
                            </div>
                            <div class="col-md-2">
                                {{ Form::activeDropDownList('', 'visita_terceiros', $model->visita_terceiros, DropDownTool::getSimNaoBoolean(), array('class'=>'form-control guru-select', 'placeholder'=>'...')) }}
                            </div>
                            <div class="col-md-5">

                            </div>
                        </div>

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

            <?php } ?>
            </div>

        </div>
    </div>

@endsection