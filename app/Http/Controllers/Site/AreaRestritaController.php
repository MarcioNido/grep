<?php

namespace App\Http\Controllers\Site;

use App\Http\Components\CHtml;
use App\Http\Controllers\Controller;
use App\Site\CadImovel;
use App\Site\Localidade;
use App\Site\NotificacaoImovel;
use App\Site\TrabalheConosco;
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
        $imoveis = CadImovel::where(['user_id' => Auth::id(), 'active' => 1])->get();
        $trabalhe = TrabalheConosco::where(['user_id' => Auth::id()])->first();
        return view('site.area-restrita.index', ['alertasImoveis' => $alertasImoveis, 'imoveis' => $imoveis, 'trabalhe' => $trabalhe]);
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

        $alerta->tipo_negocio = $request->tipo_negocio;
        $alerta->tipo_imovel = $request->tipo_imovel;
        $alerta->estado = $request->estado;
        $alerta->codcidade = $request->codcidade;
        $alerta->codbairro = serialize($request->codbairro);
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

    public function ebook()
    {
        return view('site.area-restrita.ebook');
    }

    public function ebookDownload()
    {
        return view('site.area-restrita.ebook-download');
    }

    public function ebookCorretor()
    {
        return view('site.area-restrita.ebook-corretor');
    }

    public function ebookCorretorDownload()
    {
        return view('site.area-restrita.ebook-corretor-download');
    }



}