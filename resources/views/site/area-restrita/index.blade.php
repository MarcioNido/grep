<?php
use App\Http\Components\CHtml;
$title = 'Área Restrita';
$breadcrumbs = [
        'Home' => url('/'),
        'Área Restrita' => '',
];
?>

@extends('layouts.app')

@section('title', $title)

@section('content')

<div style="width: 100%; height: 100%; background-color: #E1ECF8;">

    <div class="container" style="padding-top: 40px; padding-bottom: 80px;">

        {{ Form::flash_message() }}

        <div class="row">

            <?php if ($alertasImoveis != null && count($alertasImoveis) > 0) { ?>

                <div class="col-md-6">

                    <div class="panel panel-primary">
                        <div class="panel-heading">CLIENTES</div>
                        <div class="panel-body">

                            @foreach($alertasImoveis as $alertaImovel)

                                <?php
                                        $perfil = \App\Site\ImovelUtil::searchDescription($alertaImovel->toArray());
                                ?>

                            <ul class="list-group">
                                <li class="list-group-item">
                                    <h4 class='list-group-item-heading'>Alerta por Email</h4>
                                    <h5>{{ $perfil['title'] }}</h5>
                                    <h5>{{ $perfil['caracteristicas'] }}</h5>
                                    <?php echo CHtml::a('Configurar', "/area-restrita/edita-alerta/{$alertaImovel->id}", ['class'=>'btn btn-warning']); ?>
                                    <?php echo CHtml::a('Cancelar Alerta', "/area-restrita/cancela-alerta/{$alertaImovel->id}", ['class'=>'btn btn-default']); ?>
                                </li>
                            </ul>
                            @endforeach

                        </div>

                    </div>

                </div>


            <?php } ?>

            <div class="col-md-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">PROPRIET&Aacute;RIOS</div>
                    <div class="panel-body">

                        @if ($imoveis != null)

                            @foreach($imoveis as $imovel)

                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <p>{{ $imovel->getEnderecoCompleto() }}</p>
                                        <?php echo  CHtml::a('Editar Dados', "/area-restrita/cadastro-imovel/{$imovel->id}", ['class'=>'btn btn-warning']); ?>
                                        <?php echo  CHtml::a('Enviar Fotos', "/area-restrita/envia-fotos/{$imovel->id}", ['class'=>'btn btn-warning']); ?>
                                        <?php echo  CHtml::a('Cancelar/Suspender', "/area-restrita/cancela-imovel/{$imovel->id}", ['class'=>'btn btn-default']); ?>
                                    </li>
                                </ul>

                            @endforeach

                        @endif

                        <?php echo  CHtml::a("Anunciar Im&oacute;vel", '/area-restrita/cadastro-imovel', ['class'=>'btn btn-primary']); ?>

                    </div>

                </div>




            </div>

            <div class="col-md-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">CONFIGURA&Ccedil;&Otilde;ES</div>
                    <div class="panel-body">
                        <?php echo  CHtml::a("Alterar dados pessoais", '/area-restrita/dados-pessoais', ['class'=>'btn btn-primary']); ?>
                    </div>
                </div>

            </div>

            @if ($trabalhe != null)
            <div class="col-md-6">
                <div class="panel panel-warning">
                    <div class="panel-heading">CORRETORES</div>
                    <div class="panel-body">
                        <p>Configure aqui o seu perfil</p>
                        <?php echo  CHtml::a("Configurar Perfil", "/area-restrita/trabalhe-conosco/{$trabalhe->id}", ['class'=>'btn btn-warning']); ?>
                    </div>
                </div>
            </div>
            @endif

        </div>


    </div>

</div>

@endsection
