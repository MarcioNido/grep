<?php
/* @var $this yii\web\View */
use App\Http\Components\CHtml as CHtml;
use App\Site\Localidade;
use App\DropDownTool;

$title = "Alerta por E-mail";
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

            <div class="col-lg-10 col-lg-offset-1">

                <div class="panel panel-primary">

                    <div class="panel-heading">Pesquisa Ativa</div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-9">

                                {{ Form::errors() }}

                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ Form::activeDropDownList('Tipo de Negócio', 'tipo_negocio', $alerta->tipo_negocio, ['venda'=>'Comprar', 'locacao'=>'Alugar'], ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%']) }}
                                    </div>
                                    <div class="col-sm-6">
                                        {{ Form::activeDropDownList('Tipo de Imóvel', 'tipo_imovel', $alerta->tipo_imovel, ['apartamento'=>'Apartamento', 'casa'=>'Casa', 'comercial'=>'Comercial', 'terreno'=>'Terreno', 'flat' => 'Flat', 'rural' => 'Rural'], ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        {{ Form::activeDropDownList('Estado', 'estado', $alerta->estado, DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'onchange' => 'trigger_estado()', 'id'=>'estado', 'placeholder'=>'Estado']) }}
                                    </div>
                                    <div class="col-sm-9">
                                        <span id="ph_codcidade">
                                            {{ Form::activeDropDownList('Cidade', 'codcidade', $alerta->codcidade, DropDownTool::getCidade($alerta->estado, 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codcidade', 'placeholder' => 'Cidade', 'onchange' => 'trigger_codcidade()']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <span id="ph_codbairro">
                                            {{ Form::activeDropDownList('Região', 'codbairro[]', unserialize($alerta->codbairro), DropDownTool::getBairro($alerta->codcidade, 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'multiple' => 'multiple']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeDropDownList('Dormitórios', 'dormitorios', $alerta->dormitorios, [1=>'1+', 2=>'2+', 3=>'3+', 4=>'4+', 5=>'5+'], ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder'=>'Indiferente']) }}
                                    </div>

                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeDropDownList('Vagas', 'vagas', $alerta->vagas, [1=>'1+', 2=>'2+', 3=>'3+', 4=>'4+', 5=>'5+'], ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder'=>'Indiferente']) }}
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeText('Área Mínima', 'area_minima', ($alerta->area_minima ?: ""), ['style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeText('Área Máxima', 'area_maxima', ($alerta->area_maxima ?: ""), ['style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeText('Valor Mínimo', 'valor_minimo', ($alerta->valor_minimo ?: ""), ['style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true' ]) }}
                                    </div>
                                    <div class="col-lg-3 col-xs-6">
                                        {{ Form::activeText('Valor Máximo', 'valor_maximo', ($alerta->valor_maximo ?: ""), ['style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true' ]) }}
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">Envio de Email desta Pesquisa</div>
                                    <div class="panel-body">
                                        {{ Form::activeRadio('Diariamente',         'frequencia', 1,  $alerta->frequencia) }}
                                        {{ Form::activeRadio('Uma vez por semana',  'frequencia', 7,  $alerta->frequencia) }}
                                        {{ Form::activeRadio('A cada 15 dias',      'frequencia', 15, $alerta->frequencia) }}
                                        {{ Form::activeRadio('Uma vez por mês',     'frequencia', 30, $alerta->frequencia) }}
                                        {{ Form::activeRadio('Não enviar emails',   'frequencia', 0,  $alerta->frequencia) }}
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
    function trigger_estado()
    {
        $.ajax('/dropdown/cidade/'+$('#estado').val())
            .done(function(response) {
                $('#ph_codcidade').html(response)
                $("#codcidade").select2({
                    theme: "bootstrap",
                    minimumResultsForSearch: 15
                });
            })
            .fail(function() {
                alert('Ocorreu um erro ao recuperar cidades ...');
            });
    }

    function trigger_codcidade()
    {
        $.ajax('/dropdown/bairro/'+$('#codcidade').val())
            .done(function(response) {
                $('#ph_codbairro').html(response)
                $("#codbairro").select2({
                    theme: "bootstrap",
                    minimumResultsForSearch: 15
                });
            })
            .fail(function() {
                alert('Ocorreu um erro ao recuperar bairros ...');
            });
    }

</script>