<?php
/* @var $this yii\web\View */
use App\Http\Components\CHtml as CHtml;
use App\Site\Localidade;
$title = "Dados Pessoais";
$breadcrumbs = [
        'Home' => url('/'),
        'Área Restrita' => url('/area-restrita/index'),
        'Edita Alerta' => '',
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

                <div class="col-lg-8 col-lg-offset-2">

                    <div class="panel panel-primary">

                        <div class="panel-heading">Dados Pessoais</div>

                        <div class="panel-body">

                            <div class="row">

                                <div class="col-lg-9">

                                    {{ Form::errors() }}

                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{ Form::activeText('Nome', 'name', $user->name) }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{ Form::activeText('Email', 'email', $user->email) }}
                                        </div>
                                    </div>

                                    <div class="panel">
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{ Form::activeCheckBox('Receber e-mails sobre ofertas de imóveis', 'optin_oferta', $user->optin_oferta) }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{ Form::activeCheckBox('Receber e-mails sobre mercado imobiliário', 'optin_mercado', $user->optin_mercado) }}
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{ Form::activeCheckBox('Receber e-mails sobre franquias imobiliárias', 'optin_franquia', $user->optin_franquia) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            {{ Form::activePassword('Senha', 'password') }}
                                        </div>
                                        <div class="col-sm-6">
                                            {{ Form::activePassword('Confirmação de Senha', 'password_confirmation' ) }}
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
                </div>
            </div>

            {{ Form::close() }}

        </div>
    </div>

@endsection