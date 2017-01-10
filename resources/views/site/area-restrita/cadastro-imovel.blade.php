<?php
/* @var $this yii\web\View */
use App\DropDownTool;
$title = "Cadastro de Imóvel";
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

                    <div class="panel-heading">Cadastro de Imóvel</div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-9">

                                {{ Form::errors() }}

                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ Form::activeDropDownList('Tipo de Imóvel', 'codtiposimplificado', $imovel->codtiposimplificado, DropDownTool::getTipoSimplificado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'onchange' => 'trigger_codtiposimplificado()', 'id'=>'codtiposimplificado', 'placeholder'=>'Selecione ...']) }}
                                    </div>
                                    <div class="col-sm-6">
                                        <span id="ph_codtipoimovel">
                                            {{ Form::activeDropDownList('Subtipo de Imóvel', 'codtipoimovel', $imovel->codtipoimovel, DropDownTool::getTipoImovel($imovel->codtiposimplificado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('CEP', 'cep', $imovel->cep, ['onchange' => 'trigger_cep()']) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeDropDownList('Tipo', 'tipo_logradouro', $imovel->tipo_logradouro, \App\DropDownTool::getTipoLogradouro(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...']) }}
                                    </div>
                                </div>


                            </div>

                            <div class="col-lg-3">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">Autorizações deste Imóvel</div>
                                    <div class="panel-body">
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

@push('scripts')
<script language="javascript">
    function trigger_codtiposimplificado()
    {
        $.ajax('/area-restrita/cadastro-imovel/tipo-imovel/'+$('#codtiposimplificado').val())
                .done(function(response) {
                    $('#ph_codtipoimovel').html(response)
                    $("#codtipoimovel").select2({
                        theme: "bootstrap",
                        minimumResultsForSearch: 15
                    });
                })
                .fail(function() {
                    alert('Ocorreu um erro ao recuperar os tipos de imóveis ...');
                });
    }
</script>
@endpush