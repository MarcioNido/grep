<?php
use App\Http\Components\CHtml;
use App\Site\Localidade;
use App\DropDownTool;
?>

<div class="panel" style="background-color: #FFFFFF;">
    <form id='form_filter' class="form-group" method="post" action='/pesquisa/digest'>
        {{ csrf_field() }}
        <input type="hidden" name="order" id="order" value="{{ $filter['order'] }}" />
        <input type="hidden" name="page" id="page" value="{{ $filter['order'] }}" />
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="btn-group btn-group-justified" role="group">
                        <input type='hidden' name="tipo_negocio" value='{{ $filter['tipo_negocio'] }}' id='tipo_negocio' />
                        <div class="btn-group" role="group">
                            <button type="button" class="guru-form-button btn <?php if ($filter['tipo_negocio'] == "venda") {echo 'btn-primary';} else {echo 'btn-default';} ?>" style="width: 100%" onclick="filtroTipoNegocio('venda');">Comprar</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="guru-form-button btn  <?php if ($filter['tipo_negocio'] == "locacao") {echo 'btn-primary';} else {echo 'btn-default';} ?>" style="width: 100%" onclick="filtroTipoNegocio('locacao');">Alugar</button>
                        </div>                                        

                    </div>

                </div>

            </div>
        </div>                            
        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-3" style="padding-right: 1px;">
                    {{ Form::activeDropDownList('Estado', 'estado', $filter['estado'], DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'onchange' => 'trigger_estado()', 'id'=>'estado', 'placeholder'=>'Estado']) }}
                </div>
                <div class="col-md-9" style="padding-left: 1px;">
                    <span id="ph_codcidade">
                        {{ Form::activeDropDownList('Cidade', 'codcidade', $filter['codcidade'], DropDownTool::getCidade($filter['estado'], 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codcidade', 'placeholder' => 'Cidade', 'onchange' => 'trigger_codcidade()']) }}
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <span id="ph_codbairro">
                        {{ Form::activeDropDownList('Região', 'codbairro[]', $filter['codbairro'], DropDownTool::getBairro($filter['codcidade'], 'titleCase'), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codbairro', 'multiple' => 'multiple', 'data-placeholder' => 'Todas as Regiões']) }}
                        <h6 style="color: #286090">* filtre regiões ou adicione escrevendo acima</h6>
                    </span>
                    <input type="hidden" name="codbairro[]" />
                </div>
            </div>

        </div>
        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tipo_imovel">Tipo de Im&oacute;vel</label>
                        <?php echo CHtml::dropDownList('tipo_imovel', $filter['tipo_imovel'], ['apartamento'=>'Apartamento', 'casa'=>'Casa', 'comercial'=>'Comercial', 'terreno'=>'Terreno', 'flat' => 'Flat', 'rural' => 'Rural'], ['class'=>'form-control guru-select', 'style' => 'width: 100%', 'id' => 'tipo_imovel']); ?>
                    </div>
                </div>                                
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Form::activeDropDownList('Subtipo de Imóvel', 'subtipo_imovel', $filter['subtipo_imovel'], \App\DropDownTool::getTipoImovelDesc($filter['tipo_imovel']), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'placeholder' => 'Selecione ...', 'id' => 'subtipo_imovel']) }}
                </div>
            </div>
        </div>

        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="valor_minimo">Valor M&iacute;nimo</label>
                        <?= CHtml::textInput('valor_minimo', $filter['valor_minimo'], ['class'=>'form-control filtro', 'style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true' ]) ?>
                    </div>
                </div>                                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="valor_maximo">Valor M&aacute;ximo</label>
                        <?= CHtml::textInput('valor_maximo', $filter['valor_maximo'], ['class'=>'form-control filtro', 'style'=>'text-align: right;', 'placeholder' => 'Indiferente', 'data-mask' => '#.##0', 'data-mask-reverse' => 'true']) ?>
                    </div>
                </div>                                       
            </div>
        </div>     

        @if ( $filter['tipo_imovel'] != 'comercial' && $filter['tipo_imovel'] != 'terreno' )
        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-12">
                    <label>Dormit&oacute;rios</label>
                    
                    @if ($filter['dormitorios'] > 0) 
                    <a href="javascript:void(0)" onclick="filtroDormitorios(0)" style="float: right;"><span class="fa fa-close"></span></a>
                    @endif
                    
                    <input type="hidden" id="dormitorios" name="dormitorios" value="{{ $filter['dormitorios'] }}" />
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['dormitorios'] == 1 ? 'btn-primary' : 'btn-default' }}" onclick="filtroDormitorios(1)">1+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['dormitorios'] == 2 ? 'btn-primary' : 'btn-default' }}" onclick="filtroDormitorios(2)">2+</button>
                        </div>                                        
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['dormitorios'] == 3 ? 'btn-primary' : 'btn-default' }}" onclick="filtroDormitorios(3)">3+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['dormitorios'] == 4 ? 'btn-primary' : 'btn-default' }}" onclick="filtroDormitorios(4)">4+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['dormitorios'] == 5 ? 'btn-primary' : 'btn-default' }}" onclick="filtroDormitorios(5)">5+</button>
                        </div>     
                    </div>
                </div>                                
            </div>
        </div>
        @endif

        @if ( $filter['tipo_imovel'] != 'terreno' )
        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-12">
                    <label>Vagas de Garagem</label>
                    @if ($filter['vagas'] > 0) 
                    <a href="javascript:void(0)" onclick="filtroVagas(0)" style="float: right;"><span class="fa fa-close"></span></a>
                    @endif
                    
                    <input type="hidden" id="vagas" name="vagas" value="{{ $filter['vagas'] }}" />
                    <div class="btn-group btn-group-justified" role="group">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['vagas'] == 1 ? 'btn-primary' : 'btn-default' }}" onclick="filtroVagas(1)">1+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['vagas'] == 2 ? 'btn-primary' : 'btn-default' }}" onclick="filtroVagas(2)">2+</button>
                        </div>                                        
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['vagas'] == 3 ? 'btn-primary' : 'btn-default' }}" onclick="filtroVagas(3)">3+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['vagas'] == 4 ? 'btn-primary' : 'btn-default' }}" onclick="filtroVagas(4)">4+</button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn {{ $filter['vagas'] == 5 ? 'btn-primary' : 'btn-default' }}" onclick="filtroVagas(5)">5+</button>
                        </div>     
                    </div>
                </div>                                
            </div>
        </div>
        @endif

        <div class="panel-body" style="border-bottom: 1px solid #CCCCCC;">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fValorMin">&Aacute;rea M&iacute;nima</label>
                        <?= CHtml::textInput('area_minima', $filter['area_minima'], ['class'=>'form-control filtro', 'style'=>'text-align: right;', 'placeholder' => 'Indiferente']) ?>
                    </div>
                </div>                                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fValorMax">&Aacute;rea M&aacute;xima</label>
                        <?= CHtml::textInput('area_maxima', $filter['area_maxima'], ['class'=>'form-control filtro', 'style'=>'text-align: right;', 'placeholder' => 'Indiferente']) ?>
                    </div>
                </div>                                       
            </div>
        </div>  

    </form>

</div>


@push('scripts')
<script languague='javascript'>
function filtroTipoNegocio(tipo) 
{
    $('#tipo_negocio').val(tipo);
    sendForm();
}

function filtroDormitorios(dorms)
{
    $('#dormitorios').val(dorms);
    sendForm();
}

function filtroVagas(vagas)
{
    $('#vagas').val(vagas);
    sendForm();
}


function sendForm()
{
    $('#ph_resultado').css('opacity', '0.5');
    $.ajax('/geturl/'+$('#tipo_negocio').val()+'/'+$('#tipo_imovel').val()+'/'+$('#estado').val()+'/'+$('#codcidade').val()+'/'+$('#codbairro').val())
        .done(function(url) {
            $('#form_filter').attr('action', url);
            $('#form_filter').submit();
        })
        .fail(function() {
            window.alert('Ocorreu um erro ao processar a requisição');
        });
}

$(document).ready(function() {

    $('#tipo_imovel').change(function() {
        $('#subtipo_imovel').val("");
        sendForm();
    })

    $('.filtro').change(function() {
        sendForm();
    });
    
    $('.pagination').click(function() {
       $('#ph_resultado').css('opacity', '0.5');
    });
    
});


function changeOrder()
{
    $('#order').val($('#orderSelect').val());
    sendForm();
}

</script>
@endpush