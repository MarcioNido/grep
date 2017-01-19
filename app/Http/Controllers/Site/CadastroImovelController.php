<?php

namespace App\Http\Controllers\Site;

use App\Http\Components\CHtml;
use App\Http\Controllers\Controller;
use App\Site\CadImovel;
use App\Site\Localidade;
use App\Site\NotificacaoImovel;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DropDownTool;
use App\Site\Cep;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class CadastroImovelController extends Controller
{

    public function edita(Request $request)
    {

        if (isset($request->id) && $request->id != 0) {
            $imovel = CadImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
            if (! $imovel) {
                throw new \Exception("Imóvel não encontrado ...", 404);
            }
        } else {
            $imovel = new CadImovel();
            $imovel->user_id = Auth::id();
        }

        if ($request->isMethod('post')) {

            $imovel->fill($request->all());
            $imovel->agencia_id = 24;
            $imovel->data_hora_cadastro = (new \DateTime())->format('Y-m-d H:i:s');
            $imovel->valor_venda = CHtml::removeMask($imovel->valor_venda);
            $imovel->valor_locacao = CHtml::removeMask($imovel->valor_locacao);
            $imovel->valor_iptu = CHtml::removeMask($imovel->valor_iptu);
            $imovel->valor_condominio = CHtml::removeMask($imovel->valor_condominio);
            $imovel->areautilconstruida = CHtml::removeMask($imovel->areautilconstruida);
            $imovel->areatotalterreno = CHtml::removeMask($imovel->areatotalterreno);
            $imovel->nascimento = CHtml::dateUs($imovel->nascimento);
            $imovel->telefone1 = CHtml::phoneRemoveMask($imovel->telefone1);
            $imovel->telefone2 = CHtml::phoneRemoveMask($imovel->telefone2);
            $imovel->bloco = (int) $imovel->bloco;
            $imovel->saveOrFail();
            return redirect('/area-restrita/index');
        }

        $imovel->nascimento = CHtml::dateBr($imovel->nascimento);

        return view('site.area-restrita.cadastro-imovel', ['imovel' => $imovel]);

    }


    /**
     * Cancela um imóvel
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \Exception
     */
    public function cancelaImovel(Request $request)
    {
        $imovel = CadImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
        if (! $imovel) {
            throw new \Exception("Imóvel não encontrado ...", 404);
        }

        if ($request->isMethod('post')) {

            $imovel->active = 0;
            $imovel->tipo_cancelamento = $request->tipo_cancelamento;
            $imovel->motivo_cancelamento = $request->motivo_cancelamento;
            $imovel->saveOrFail();

            session()->flash('flash_message', 'O Imóvel foi Cancelado com sucesso!');
            return redirect('area-restrita/index');

        }

        return view('site.area-restrita.cancela-imovel', ['imovel' => $imovel]);

    }

    public function enviaFotos(Request $request)
    {
        $imovel = CadImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
        if (! $imovel) {
            throw new \Exception("Imóvel não encontrado ...", 404);
        }

        if ($request->isMethod('post')) {
            $file = Input::file('file');
            if ($file) {
                $destination_path = public_path().'/uploads/' . $imovel->id . '/';
                $filename = $file->getClientOriginalName();
                $upload_success = Input::file('file')->move($destination_path, $filename);
                if ($upload_success) {
                    return Response::json('success', 200);
                } else {
                    return Response::json('error', 400);
                }
            }
        }

        return view('site.area-restrita.envia-fotos', ['imovel' => $imovel]);

    }

    public function fotosEnviadas()
    {
        return view('site.area-restrita.fotos-enviadas');
    }


    public function tipoimovel($codtiposimplificado=0)
    {
        return FormFacade::activeDropDownList('Subtipo de Imóvel', 'codtipoimovel', 0, DropDownTool::getTipoImovel($codtiposimplificado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codtipoimovel', 'placeholder' => 'Selecione ...']);
    }

    public function cidade($estado='')
    {
        return FormFacade::activeDropDownList('Cidade', 'codcidade', 0, DropDownTool::getCidade($estado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codcidade', 'placeholder' => '...', 'onchange' => 'trigger_codcidade()']);
    }

    public function bairro($codcidade=0)
    {
        return FormFacade::activeDropDownList('Bairro', 'codbairro', 0, DropDownTool::getBairro($codcidade), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codbairro', 'placeholder' => '...']);
    }

    public function cep($cep='')
    {
        $endereco = Cep::where(['cep' => $cep])->first();
        $response = [
            'tipo_logradouro' => $endereco->codtipologradouro,
            'endereco' => $endereco->endereco,
            'numero' => $endereco->numero,
            'estado' => FormFacade::activeDropDownList('Estado', 'estado', $endereco->cidade->siglaestado, DropDownTool::getEstado(), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'estado', 'placeholder' => '...', 'onchange' => 'trigger_estado()'])->toHtml(),
            'codcidade' => FormFacade::activeDropDownList('Cidade', 'codcidade', $endereco->codcidade, DropDownTool::getCidade($endereco->cidade->siglaestado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codcidade', 'placeholder' => '...', 'onchange' => 'trigger_codcidade()'])->toHtml(),
            'codbairro' => FormFacade::activeDropDownList('Bairro', 'codbairro', $endereco->codbairro, DropDownTool::getBairro($endereco->codcidade), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codbairro', 'placeholder' => '...'])->toHtml(),
        ];
        echo json_encode($response);
    }

}