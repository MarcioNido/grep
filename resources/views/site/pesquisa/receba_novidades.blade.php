<?php if (!empty($filter_desc)) { ?>
<div class="container">
    <div class="row">
        <div class="col-lg-10 col-md-offset-1" style="text-align: left;">
            <h3 style="color: #FAFAFA; font-weight: 300">Receba novos im&oacute;veis e atualiza&ccedil;&otilde;es relacionadas &agrave;
                sua pesquisa direto em sua caixa de e-mail!</h3>
            <h5 style="color: #E7E7E7; font-weight: 300;"></h5>
        </div>

    </div>
    <div class="row">

        <div class="col-md-11 col-md-offset-1">

            <div class="row">

                <?php foreach($filter_desc as $item_perfil) { ?>
                    <div class="col-md-4" >
                        <h5 style="color: #CCCCCC"><span class="fa fa-check"></span> {{ $item_perfil }}</h5>
                    </div>
                <?php } ?>

            </div>

        </div>


    </div>
    <div class="row" style="margin-top: 30px;">
        <div class="col-lg-10 col-md-offset-1">
            <a class="btn btn-warning" href="{{ url('pesquisa/notificacao-imovel') }}">QUERO RECEBER AS OPORTUNIDADES!</a>
        </div>
    </div>
</div>
<?php } ?>