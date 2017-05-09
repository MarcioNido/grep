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
                <h1>Painel do Proprietário</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <br />
                <h5>
                    <b>
                        Obrigado pela informação. Sua informação já está registrada.<br />
                    </b>
                </h5>

                @if( $model->resposta == 'NEGOCIADO' )
                    <h6>Caso queira deixar algum comentário, por favor preencha no campo abaixo e após terminar clique no botão ENVIAR.</h6>
                @endif

                @if ($model->resposta == 'ALTERAÇÕES')
                    <h6>Por favor, descreva no campo abaixo as alterções necessárias e após terminar clique no botão ENVIAR.</h6>
                @endif

                @if ($model->resposta == 'ATUALIZADO')
                    <h6>Seu imóvel já será atualizado. Caso queira deixar algum comentário, por favor preencha abaixo e após terminar clique no botão ENVIAR.</h6>
                @endif

                <form method="post">
                    {{ csrf_field() }}

                    <div class="row" style="margin-top: 35px;">
                        <div class="col-md-12">
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