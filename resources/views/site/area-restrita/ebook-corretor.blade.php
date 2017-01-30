<?php
/* @var $this yii\web\View */
use App\Http\Components\CHtml as CHtml;
use App\Site\Localidade;
$title = "Download E-book";
$breadcrumbs = [
    'Home' => url('/'),
    'Área Restrita' => url('/area-restrita/index'),
    'Download E-book Corretor' => '',
];
?>
@extends('layouts.app')

@section('title', $title)

@section('content')

<div style="width: 100%; background-color: #E1ECF8;">
    <div class="container" style="padding-top: 40px; padding-bottom: 80px;">

        <div class="row">

            <div class="col-lg-6 col-lg-offset-3">

                <div class="panel panel-primary">

                    <div class="panel-heading">Clique na Imagem Para Iniciar o Download</div>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="thumbnail">
                                    <a href="/area-restrita/ebook-download">
                                        <img class="img-responsive" src="/images/Capa_Ebook-logo1.png" />
                                    </a>
                                </div>

                            </div>

                        </div>



                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection