@extends('site.emails.email')

@section('content')
    <table width="100%" align="center" border="0" cellspacing="0" cellpadding="10" bgcolor="#FFFFFF" class="font-size: 14px;">
        <tr><td colspan="2"><b>Novo Contato - Site Leardi</b></td></tr>
        <tr><td width="20%">Nome:</td><td>{{ $contato->nome }}</td></tr>
        <tr><td>E-mail:</td><td>{{ $contato->email }}</td></tr>
        <tr><td>Telefone:</td><td>{{ $contato->ddd }} {{ $contato->telefone }}</td></tr>
        <tr><td>Imóvel:</td><td>{{ $contato->imovel_id }}</td></tr>
        <tr><td>Mensagem:</td><td>{{ $contato->mensagem }}</td></tr>
    </table>
    <br />
    <br />
@endsection
