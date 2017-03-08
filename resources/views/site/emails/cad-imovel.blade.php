<?php
use App\Http\Components\CHtml;
?>
@extends('site.emails.email')

@section('content')
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10" bgcolor="#FFFFFF" class="font-size: 14px;">
        <tr><td colspan="2"><b>Novo Cadastro de Imóvel - Site Leardi</b></td></tr>
        <tr><td colspan="2">DADOS DO PROPRITÁRIO</td></tr>
        <tr><td width="20%">Nome:</td><td>{{ $cadImovel->nome }}</td></tr>
        <tr><td>E-mail:</td><td>{{ $cadImovel->email }}</td></tr>
        <tr><td>Telefone:</td><td>{{ $cadImovel->ddd }} {{ $cadImovel->telefone }}</td></tr>
        <tr><td>CPF:</td><td>{{ $cadImovel->cpf }}</td></tr>
        <tr><td>Nascimento:</td><td>{{ CHtml::dateBr($cadImovel->nascimento) }}</td></tr>
        <tr><td>Nacionalidade:</td><td>{{ $cadImovel->nacionalidade }}</td></tr>
        <tr><td>Profissão:</td><td>{{ $cadImovel->profissao }}</td></tr>
        <tr><td>Mensagem:</td><td>{{ $cadImovel->mensagem }}</td></tr>
        <tr><td colspan="2">DADOS DO IMÓVEL</td></tr>
        <tr><td>Tipo Simplificado:</td><td>{{ $cadImovel->tipoSimplificado->descricao }}</td></tr>
        <tr><td>Tipo Imóvel:</td><td>{{ $cadImovel->tipoImovel->descricao }}</td></tr>
        <tr><td>CEP:</td><td>{{ $cadImovel->cep }}</td></tr>
        <tr><td>Endereço:</td><td>{{ $cadImovel->getEnderecoCompleto() }}</td></tr>
        <tr><td>Bairro:</td><td>{{ $cadImovel->bairro->descricao }}</td></tr>
        <tr><td>Cidade:</td><td>{{ $cadImovel->cidade->descricao }}</td></tr>
        <tr><td>Estado:</td><td>{{ $cadImovel->estado }}</td></tr>
        <tr><td>Valor Venda:</td><td>{{ CHtml::moneyMask($cadImovel->valor_venda) }}</td></tr>
        <tr><td>Valor Locação:</td><td>{{ CHtml::moneyMask($cadImovel->valor_locacao) }}</td></tr>
        <tr><td>Valor Condomínio:</td><td>{{ CHtml::moneyMask($cadImovel->valor_condominio) }}</td></tr>
        <tr><td>Valor IPTU:</td><td>{{ CHtml::moneyMask($cadImovel->valor_iptu) }}</td></tr>
        <tr><td>Dormitórios:</td><td>{{ $cadImovel->dormitorio }}</td></tr>
        <tr><td>Suítes:</td><td>{{ $cadImovel->suite }}</td></tr>
        <tr><td>Vagas:</td><td>{{ $cadImovel->vaga }}</td></tr>
        <tr><td>Área Total/Terr.:</td><td>{{ $cadImovel->areatotalterreno }}</td></tr>
        <tr><td>Área Útil/Constr.:</td><td>{{ $cadImovel->areautilconstruida }}</td></tr>
        <tr><td>Observações:</td><td>{{ $cadImovel->obs_imovel }}</td></tr>
    </table>
    <br />
    <br />
@endsection
