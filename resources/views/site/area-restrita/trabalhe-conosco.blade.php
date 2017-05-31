<?php
/* @var $this yii\web\View */
use App\DropDownTool;
$title = "Trabalhe Conosco";
$breadcrumbs = [
        'Home' => url('/'),
        'Área Restrita' => url('/area-restrita/index'),
        'Trabalhe Conosco'=>'',
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

                    <div class="panel-heading">Trabalhe Conosco</div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-12">

                                {{ Form::errors() }}

                                <div class="row">
                                    <div class="col-sm-6">
                                        {{ Form::activeText('Nome', 'nome', $trabalhe->nome) }}
                                    </div>
                                    <div class="col-sm-6">
                                        {{ Form::activeText('Email', 'email', $trabalhe->email) }}
                                    </div>
                                </div>

                                <div class="row" style="margin-top: 40px;">
                                    <div class="col-md-2">
                                        {{ Form::activeText('CEP', 'cep', $trabalhe->cep, ['onchange' => 'trigger_cep()', 'id' => 'cep']) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeDropDownList('Tipo', 'tipo_logradouro', $trabalhe->tipo_logradouro, \App\DropDownTool::getTipoLogradouro(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...', 'id' => 'tipo_logradouro']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::activeText('Endereço', 'endereco', $trabalhe->endereco, ['id' => 'endereco']) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Número', 'numero', $trabalhe->numero, ['id' => 'numero']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('Unidade', 'unidade', $trabalhe->unidade) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('Bloco', 'bloco', $trabalhe->bloco) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Complemento', 'complemento', $trabalhe->complemento) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <span id="ph_estado">
                                            {{ Form::activeDropDownList('Estado', 'estado', $trabalhe->estado, \App\DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'onchange' => 'trigger_estado()', 'id'=>'estado']) }}
                                        </span>
                                    </div>
                                    <div class="col-md-4">
                                        <span id="ph_codcidade">
                                            {{ Form::activeDropDownList('Cidade', 'codcidade', $trabalhe->codcidade, \App\DropDownTool::getCidade(old('estado') ?: $trabalhe->estado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'onchange' => 'trigger_codcidade()', 'id' => 'codcidade']) }}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <span id="ph_codbairro">
                                            {{ Form::activeDropDownList('Bairro', 'codbairro', $trabalhe->codbairro, \App\DropDownTool::getBairro(old('codcidade') ?: $trabalhe->codcidade), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => '...', 'id' => 'codbairro']) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        {{ Form::activeText('CPF', 'cpf', $trabalhe->cpf) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::activeText('Data Nascimento', 'nascimento', $trabalhe->nascimento, ['data-mask' => '##/##/####']) }}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        {{ Form::activeText('DDD', 'ddd1', $trabalhe->ddd1) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Telefone', 'telefone1', $trabalhe->telefone1, ['style' => 'text-align:right', 'data-mask' => '#####-####', 'data-mask-reverse' => true]) }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ Form::activeText('DDD', 'ddd2', $trabalhe->ddd2) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::activeText('Telefone', 'telefone2', $trabalhe->telefone2, ['style' => 'text-align:right', 'data-mask' => '#####-####', 'data-mask-reverse' => true]) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        {{ Form::activeTextArea('Observações', 'mensagem', $trabalhe->mensagem) }}
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
                    $('#tipo_logradouro').val(json.tipo_logradouro).trigger('change');
                    $('#endereco').val(json.endereco);
                    $('#numero').val(json.numero);
                    $('#ph_estado').html(json.estado);
                    $('#ph_codcidade').html(json.codcidade);
                    $('#ph_codbairro').html(json.codbairro);
                    $('#estado').select2({theme: "bootstrap", minimunResultsForSearch: 15});
                    $('#codcidade').select2({theme: "bootstrap", minimunResultsForSearch: 15});
                    $('#codbairro').select2({theme: "bootstrap", minimunResultsForSearch: 15});
                })
                .fail(function() {
                    // nothing to do ?
                })
    }

</script>
@endpush