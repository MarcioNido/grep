<?php
/* @var $this yii\web\View */
use App\DropDownTool;
$title = "Cadastro de Imóvel";
$breadcrumbs = [
        'Home' => url('/'),
        'Área Restrita' => url('/area-restrita/index'),
        'Cadastro de Imóvel'=>'',
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
                                            {{ Form::activeDropDownList('Subtipo de Imóvel', 'codtipoimovel', $imovel->codtipoimovel, DropDownTool::getTipoImovel(old('codtiposimplificado') ?: $imovel->codtiposimplificado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 40px;">
                                    <div class="col-md-2">
                                        {{ Form::activeText('CEP', 'cep', $imovel->cep, ['onchange' => 'trigger_cep()', 'id' => 'cep']) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeDropDownList('Tipo', 'tipo_logradouro', $imovel->tipo_logradouro, \App\DropDownTool::getTipoLogradouro(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::activeText('Endereço', 'endereco', $imovel->endereco, ['id' => 'endereco']) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Número', 'numero', $imovel->numero) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('Unidade', 'unidade', $imovel->unidade) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Bloco', 'bloco', $imovel->bloco) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Complemento', 'complemento', $imovel->complemento) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeDropDownList('Estado', 'estado', $imovel->estado, \App\DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'onchange' => 'trigger_estado()', 'id'=>'estado']) }}
                                    </div>
                                    <div class="col-md-4">
                                        <span id="ph_codcidade">
                                            {{ Form::activeDropDownList('Cidade', 'codcidade', $imovel->codcidade, \App\DropDownTool::getCidade(old('estado') ?: $imovel->estado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'onchange' => 'trigger_codcidade()', 'id' => 'codcidade']) }}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span id="ph_codbairro">
                                            {{ Form::activeDropDownList('Bairro', 'codbairro', $imovel->codbairro, \App\DropDownTool::getBairro(old('codcidade') ?: $imovel->codcidade), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'id' => 'codbairro']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 40px;">
                                    <div class="col-md-3">
                                        {{ Form::activeText('Valor de Venda', 'valor_venda', $imovel->valor_venda, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Valor de Locação', 'valor_locacao', $imovel->valor_locacao, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('IPTU Anual', 'valor_iptu', $imovel->valor_iptu, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Valor Condomínio', 'valor_condominio', $imovel->valor_condominio, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('Dormitórios', 'dormitorio', $imovel->dormitorio) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Suítes', 'suite', $imovel->suite) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Vagas', 'vaga', $imovel->vaga) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Área Útil/Construída', 'areautilconstruida', $imovel->areautilconstruida, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Área Total/Terreno', 'areatotalterreno', $imovel->areatotalterreno, ['style'=>'text-align: right;', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::activeTextArea('Observações sobre o Imóvel', 'obs_imovel', $imovel->obs_imovel) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Dados do Proprietário</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::activeText('Nome do Proprietário', 'nome', $imovel->nome) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        {{ Form::activeText('CPF', 'cpf', $imovel->cpf) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Data Nascimento', 'nascimento', $imovel->nascimento, ['data-mask' => '##/##/####']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Nacionalidade', 'nacionalidade', $imovel->nacionalidade) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Profissão', 'profissao', $imovel->profissao) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::activeText('E-mail', 'email', $imovel->email) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('DDD', 'ddd1', $imovel->ddd1) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Telefone', 'telefone1', $imovel->telefone1) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('DDD', 'ddd2', $imovel->ddd2) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Telefone', 'telefone2', $imovel->telefone2) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::activeTextArea('Observações do Proprietário', 'mensagem', $imovel->mensagem) }}
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-3">
                                <div class="panel panel-warning">
                                    <div class="panel-heading">Autorizações deste Imóvel</div>
                                    <div class="panel-body">
                                        {{ Form::activeCheckBox('Autorizo a publicidade deste imóvel no site da Paulo Roberto Leardi e portais imobiliários, sem a divulgação do endereço completo.', 'autorizacao_publicidade', $imovel->autorizacao_publicidade) }}
                                        <br />&nbsp;
                                        {{ Form::activeCheckBox('Autorizo a instalação de placa no imóvel.', 'autorizacao_placa', $imovel->autorizacao_placa) }}
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
        $.ajax('/area-restrita/drop-down/tipo-imovel/'+$('#codtiposimplificado').val())
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
    function trigger_estado()
    {
        $.ajax('/area-restrita/drop-down/cidade/'+$('#estado').val())
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
        $.ajax('/area-restrita/drop-down/bairro/'+$('#codcidade').val())
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
    function trigger_cep()
    {
        $.getJSON('/area-restrita/busca-cep/'+$('#cep').val())
                .done(function(json) {
                    $('#endereco').val(json.endereco)
                })
                .fail(function() {
                    // nothing to do ?
                })
    }

</script>
@endpush