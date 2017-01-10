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
            $imovel->save();
            return redirect('/area-restrita/index');
        }

        return view('site.area-restrita.cadastro-imovel', ['imovel' => $imovel]);

    }

    /**
     * Edita um alerta de imóvel
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \HttpException
     */
    public function editaAlerta(Request $request)
    {
        $alerta = NotificacaoImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
        if ($alerta == null) {
            throw new \HttpException("Alerta não encontrado ...", 404);
        }
        return view('site.area-restrita.edita-alerta', ['alerta' => $alerta]);
    }

    public function storeAlerta(Request $request)
    {
        $alerta = NotificacaoImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
        if ($alerta == null) {
            throw new \HttpException("Alerta não encontrado ...", 404);
        }

        $localidade = Localidade::where(['localidade_url' => $request->localidade_url])->first();
        if ($localidade == null) {
            throw new \Exception("Localidade não encontrada", 404);
        }

        $alerta->tipo_negocio = $request->tipo_negocio;
        $alerta->tipo_imovel = $request->tipo_imovel;
        $alerta->estado = $localidade->estado;
        $alerta->cidade = $localidade->cidade;
        $alerta->regiao = $localidade->regiao;
        $alerta->dormitorios = (int) $request->dormitorios;
        $alerta->vagas = (int) $request->vagas;
        $alerta->valor_minimo = (float) CHtml::removeMask($request->valor_minimo);
        $alerta->valor_maximo = (float) CHtml::removeMask($request->valor_maximo);
        $alerta->area_minima = (float) CHtml::removeMask($request->area_minima);
        $alerta->area_maxima = (float) CHtml::removeMask($request->area_maxima);
        $alerta->saveOrFail();

        session()->flash('flash_message', 'Alerta alterado com sucesso!');

        return redirect('area-restrita/index');

    }

    /**
     * Cancela um alerta de imóveis
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     * @throws \HttpException
     */
    public function cancelaAlerta(Request $request)
    {
        $alerta = NotificacaoImovel::where(['id'=>$request->id, 'user_id'=>Auth::id()])->first();
        if ($alerta == null) {
            throw new \HttpException("Alerta não encontrado ...", 404);
        }

        if ($request->isMethod('post')) {

            $alerta->active = 0;
            $alerta->tipo_cancelamento = $request->tipo_cancelamento;
            $alerta->motivo_cancelamento = $request->motivo_cancelamento;
            $alerta->saveOrFail();

            session()->flash('flash_message', 'O Alerta foi Cancelado com sucesso!');
            return redirect('area-restrita/index');

        }

        return view('site.area-restrita.cancela-alerta', ['alerta' => $alerta]);

    }

    public function tipoimovel($codtiposimplificado=0)
    {
        return FormFacade::activeDropDownList('Subtipo de Imóvel', 'codtipoimovel', 0, DropDownTool::getTipoImovel($codtiposimplificado), ['class'=>'form-control guru-select filtro', 'style' => 'width: 100%', 'id' => 'codtipoimovel', 'placeholder' => 'Selecione ...']);
    }

}