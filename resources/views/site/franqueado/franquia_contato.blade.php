<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title">Entre em Contato</h3>
    </div>

    <form id="form_contato" class="form-group" method="POST" action="{{ url('pesquisa/contato') }}">

        {{ csrf_field() }}

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <span id="ph_response"></span>
                </div>
            </div>

            <span id="ph_form">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('nome') ? ' has-error' : '' }}">
                            <label for="nome">Nome</label>
                            <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome" value="{{ old('nome') }}">
                            <span class="help-block"><strong>{{ $errors->first('nome') }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">E-mail</label>
                            <input name="email" type="email" class="form-control" id="email" placeholder="E-mail" value="{{ old('email') }}">
                            <span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-3" style="padding-right: 1px;">
                        <div class="form-group{{ $errors->has('ddd') ? ' has-error' : '' }}">
                            <label for="ddd">DDD</label>
                            <input name="ddd" type="tel" class="form-control" id="ddd" placeholder="DDD">
                            <span class="help-block"><strong>{{ $errors->first('ddd') }}</strong></span>
                        </div>
                    </div>
                    <div class="col-xs-9" style="padding-left: 1px;">
                        <div class="form-group{{ $errors->has('telefone') ? ' has-error' : '' }}">
                            <label for="telefone">Telefone</label>
                            <input name="telefone" type="tel" class="form-control" id="telefone" placeholder="Telefone">
                            <span class="help-block"><strong>{{ $errors->first('telefone') }}</strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group{{ $errors->has('mensagem') ? ' has-error' : '' }}">
                            <label for="mensagem">Mensagem</label>
                            <textarea name="mensagem" class="form-control">Gostaria de mais informações sobre franquia imobiliária.</textarea>
                            <span class="help-block"><strong>{{ $errors->first('mensagem') }}</strong></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="envio_ofertas" value="0" />
                                <input name="envio_ofertas" type="checkbox" value="1" />
                                Gostaria de receber novidades do mercado imobiliário por e-mail
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button class="btn btn-warning" style="font-weight: 300; width: 100%;" onclick="return trigger_enviar_mensagem()"><span class="fa fa-mail-forward"></span> ENVIAR MENSAGEM</button>
                    </div>
                </div>


            </span>


        </div>

    </form>

</div>

@push('scripts')
<script language="javascript">
    function trigger_enviar_mensagem()
    {
        $.post('{{ url('seja-um-franqueado/contato') }}', $('#form_contato').serialize())
                .done(function(json) {
                    $('#ph_response').html('<div class="alert alert-success" role="alert" style="text-align:center">Mensagem Enviada !!!</div>');
                    $('#ph_form').hide('fast');
                })
                .fail(function(json) {
                    var error_message = '<div class="alert alert-danger" role="alert">';
                    error_message += '<p>Favor corrigir os erros abaixo:</p>';
                    error_message += '<ul>';
                    $.each(json.responseJSON, function(i, item) {
                        error_message += '<li>'+item+'</li>';
                    });
                    error_message += '</ul></div>';
                    $('#ph_response').html(error_message)
                });
        return false;
    }
</script>
@endpush