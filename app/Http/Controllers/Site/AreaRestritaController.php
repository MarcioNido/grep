<?php

namespace App\Http\Controllers\Site;


use App\Http\Components\CHtml;
use App\Http\Controllers\Controller;
use App\Site\Localidade;
use App\Site\NotificacaoImovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaRestritaController extends Controller
{

    /**
     * Exibe a página principal da área restrita
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $alertasImoveis = NotificacaoImovel::where(['user_id' => Auth::id(), 'active' => 1])->get();
        return view('site.area-restrita.index', ['alertasImoveis' => $alertasImoveis]);
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

        $request->valor_minimo = (float) CHtml::removeMask($request->valor_minimo);

        $this->validate($request, [
            'tipo_negocio' => 'required',
            'tipo_imovel' => 'required',
            'localidade_url'=>'required',
        ]);

        $localidade = Localidade::where(['localidade_url' => $request->localidade_url])->first();
        if ($localidade == null) {
            throw new \Exception("Localidade não encontrada", 404);
        }

        $alerta->tipo_negocio = $request->tipo_negocio;
        $alerta->tipo_imovel = $request->tipo_imovel;
        $alerta->estado = $localidade->estado;
        $alerta->cidade = $localidade->cidade;
        $alerta->regiao = $localidade->regiao;
        $alerta->dormitorios = $request->dormitorios;
        $alerta->vagas = $request->vagas;
        $alerta->valor_minimo = $request->valor_minimo;
        $alerta->valor_maximo = CHtml::removeMask($request->valor_maximo);
        $alerta->area_minima = $request->area_minima;
        $alerta->area_maxima = $request->area_maxima;
        $alerta->save();

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
            $this->validate($request, [
                'motivo_cancelamento' => 'string|max:2000',
            ]);
            $alerta->active = 0;
            $alerta->tipo_cancelamento = $request->tipo_cancelamento;
            $alerta->motivo_cancelamento = $request->motivo_cancelamento;
            $alerta->save();
            return redirect('area-restrita/index');
        }

        return view('site.area-restrita.cancela-alerta', ['alerta' => $alerta]);

    }

}