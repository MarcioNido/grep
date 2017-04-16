<?php
$title = "Paulo Roberto Leardi";
?>

@extends('layouts.app')

@section('title', $title)

@section('content')
    <div style="background-color: #345C8C; width: 100%">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="/">Home</a></li>
                <li class="active">Pesquisas</li>
            </ol>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>Obrigado pela sua participação.</h1>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script language="javascript">
    window.setTimeout(function() {
        location.href="http://www.leardi.com.br";
    }, 3000);
</script>
@endpush