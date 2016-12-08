<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title">Entre em Contato</h3>
    </div>

    <form class="form-group">

        <div class="panel-body" style="background-color: #FFFFFF;">
            <div class="row">
                <div class="col-xs-12">

                    <h4 style="font-weight: 300; margin-top: 0; margin-bottom: 0; color: #666666;">Unidade </h4>
                    <h3 style="font-weight: 300; margin-top: 0;">{{ mb_convert_case($imovel->agenciaPublicacao->nome, MB_CASE_TITLE) }}</h3>

                    <button role="button" id="ph_fone" class="btn btn-primary" style="font-weight: 300; width: 100%;" onclick="return trigger_fone({{ $imovel->pub_agencia_id }})"><span class="fa fa-phone"></span> VER TELEFONE</button>

                </div>

            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fLocal">Nome</label>
                        <input type="text" class="form-control" id="fLocal" placeholder="Nome">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3">
                    <div class="form-group">
                        <label for="fLocal">DDD</label>
                        <input type="text" class="form-control" id="fLocal" placeholder="DDD">
                    </div>
                </div>
                <div class="col-xs-9">
                    <div class="form-group">
                        <label for="fLocal">Telefone</label>
                        <input type="text" class="form-control" id="fLocal" placeholder="Telefone">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fLocal">Email</label>
                        <input type="email" class="form-control" id="fLocal" placeholder="Email">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fLocal">Observa&ccedil;&otilde;es</label>
                        <textarea class="form-control">Gostaria de mais informações sobre este imóvel.</textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" />
                            Gostaria de receber ofertas de im&oacute;veis similares por e-mail
                        </label>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <button class="btn btn-warning" style="font-weight: 300; width: 100%;"><span class="fa fa-mail-forward"></span> ENVIAR MENSAGEM</button>
                </div>
            </div>

        </div>

    </form>

</div>

@push('scripts')
<script language="javascript">
    function trigger_fone(agencia_id)
    {
        $.ajax('{{url('pesquisa/fone', ['agencia_id'=>$imovel->pub_agencia_id]) }}')
                .done(function(response) {
                    $('#ph_fone').html(response);
                })
                .fail(function() {
                    window.alert('Ocorreu um erro ao recuperar o telefone da unidade');
                });
        return false;
    }
</script>
@endpush