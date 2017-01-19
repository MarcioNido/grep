<?php
/* @var $this yii\web\View */
use App\Http\Components\CHtml as CHtml;
use App\Site\Localidade;
$title = "Cancelamento de Imóvel";
$breadcrumbs = [
    'Home' => url('/'),
    'Área Restrita' => url('/area-restrita/index'),
    'Cancelamento Imóvel'=> '',
];
?>
@extends('layouts.app')

@section('title', $title)

@section('content')

<div style="width: 100%; background-color: #E1ECF8;">
    <div class="container" style="padding-top: 40px; padding-bottom: 80px;">

        {{ Form::open() }}
        {{ csrf_field() }}

        <div class="row">

            <div class="col-lg-10 col-lg-offset-1">

                <div class="panel panel-primary">

                    <div class="panel-heading">Cancelamento de Imóvel</div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-9">

                                {{ Form::errors() }}

                                <div class="row">
                                    <div class="col-lg-12">
                                        <h5><b>Por favor, informe o motivo do cancelamento</b></h5>
                                        {{ Form::activeRadio('Prefiro não informar',         'tipo_cancelamento', null,  $imovel->tipo_cancelamento) }}
                                        {{ Form::activeRadio('Imóvel já negociado com a LEARDI',         'tipo_cancelamento', 'LEARDI',  $imovel->tipo_cancelamento) }}
                                        {{ Form::activeRadio('Imóvel já negociado com outra imobiliária',  'tipo_cancelamento', 'IMOBILIÁRIA',  $imovel->tipo_cancelamento) }}
                                        {{ Form::activeRadio('Desisti de vender/alugar',      'tipo_cancelamento', 'DESISTI', $imovel->tipo_cancelamento) }}
                                        {{ Form::activeRadio('Outros motivos',     'tipo_cancelamento', 'OUTROS', $imovel->tipo_cancelamento) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        {{ Form::activeTextArea('Observações', 'motivo_cancelamento', $imovel->motivo_cancelamento) }}
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style='text-align: right;'>
                                {{ Form::submit('Confirma', ['class' => 'btn btn-primary']) }}
                                {{ link_to('/area-restrita/index', 'Cancela', ['class' => 'btn btn-default']) }}
                            </div>
                        </div>


                    </div>

                </div>

            </div>

        </div>

        {{ Form::close() }}

    </div>

</div>

@endsection