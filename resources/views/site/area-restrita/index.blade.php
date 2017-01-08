<?php
use App\Http\Components\CHtml;
        $title = 'Área Restrita';
?>

@extends('layouts.app')

@section('title', $title)

@section('content')

<div style="width: 100%; height: 100%; background-color: #E1ECF8;">

    <div class="container" style="padding-top: 40px; padding-bottom: 80px;">

        {{ Form::flash_message() }}

        <div class="row">

            <?php if ($alertasImoveis != null) { ?>

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
                                    <h5><b>{{ $perfil['title'] }}</b></h5>
                                    <h5><b>{{ $perfil['caracteristicas'] }}</b></h5>
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
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p>Av. Padre Antonio Jose dos Santos, 313 Und.: 161</p>
                                <?php echo  CHtml::a('Editar Dados', 'area-cliente/page', ['class'=>'btn btn-warning']); ?>
                                <?php echo  CHtml::a('Gerenciar Fotos', 'area-cliente/page', ['class'=>'btn btn-warning']); ?>
                                <?php echo  CHtml::a('Cancelar/Suspender', 'area-cliente/page', ['class'=>'btn btn-default']); ?>
                            </li>
                        </ul>
                        <?php echo  CHtml::a("Anunciar Im&oacute;vel", 'area-cliente/page', ['class'=>'btn btn-primary']); ?>

                    </div>
                </div>




            </div>

            <div class="col-md-6">

                <div class="panel panel-primary">
                    <div class="panel-heading">CONFIGURA&Ccedil;&Otilde;ES</div>
                    <div class="panel-body">
                        <p><?php // echo  //Html::a("Alterar dados pessoais", ['imovel/cadastro'], ['class'=>'']); ?></p>
                        <p><?php // echo  //Html::a("Alterar configura&ccedil;&otilde;es de recebimento de email", ['imovel/cadastro'], ['class'=>'']); ?></p>
                    </div>
                </div>


                <div class="panel panel-warning">
                    <div class="panel-heading">CORRETORES</div>
                    <div class="panel-body">
                        <p>Crie o seu perfil aqui e nossos franqueados entrar&atilde;o em contato</p>
                        <?php // echo  //Html::a("Criar meu Perfil", ['imovel/cadastro'], ['class'=>'btn btn-warning']); ?>
                    </div>
                </div>

                <div class="panel panel-warning">
                    <div class="panel-heading">FRANQUIAS</div>
                    <div class="panel-body">
                        <p>Interessado em ser um Franqueado Paulo Roberto Leardi? Cadastre-se e entraremos em contato!</p>
                        <?php // echo  //Html::a("Quero Mais Informa&ccedil;&otilde;es", ['imovel/cadastro'], ['class'=>'btn btn-warning']); ?>
                    </div>
                </div>



            </div>

        </div>


    </div>

</div>

@endsection
