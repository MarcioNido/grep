<?php

namespace App\Http\Controllers\Site;

use App\Bdi\CrmFac;
use App\Bdi\EvtEmailEnviado;
use App\Bdi\EvtEmailFacCq2;
use App\Crypto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site\Interacao;

class InteracaoController extends Controller
{
    private $crypto;

    public function __construct()
    {
        $this->crypto = new Crypto('SiteCryptK#y2013');
    }

    public function index(Request $request)
    {
        $interacao = new Interacao();
        $interacao->response = $request->url();
        $interacao->save();
        return view('site.interacao.obrigado');
    }

    public function atendimento3Dias(Request $request)
    {
        //$evt_id=0, $evt_code='', $resposta=''
        $evt_id = $request->evt_id;
        $evt_code = $request->evt_code;
        $resposta = $request->resposta;

        if (base64_encode($this->crypto->encrypt($evt_id)) == $evt_code) {
            // pega o evento de e-mail enviado ...
            $evt_email_enviado = EvtEmailEnviado::where('evt_email_enviado_id', $evt_id)->first();
            if ($evt_email_enviado == null) {
                abort(404);
            }

            $crmFac = CrmFac::where('fac_id', $evt_email_enviado->chave_id)->first();
            if ($crmFac == null) {
                $tipo_negocio = 'V';
            } else {
                $tipo_negocio = $crmFac->tipo_negocio;
            }
            if ($tipo_negocio == null || $tipo_negocio == '') {
                $tipo_negocio = 'V';
            }

            $model = EvtEmailFacCq2::where('evt_email_enviado_id', $evt_id)->first();
            if ($model == null) {
                $model = new EvtEmailFacCq2();
                $model->evt_email_enviado_id = $evt_id;
                $model->email_id = $evt_email_enviado['email_id'];
            }

            // esta parte sempre grava, porque o cliente pode clicar em outra opção ...
            $model->resposta = $resposta;
            if (($resposta == 'RUIM' || $resposta == 'SEM RETORNO') && $tipo_negocio == 'V') {
                $model->alerta = 1;
            } else {
                $model->alerta = 0;
            }

            $model->saveOrFail();

            if ($request->isMethod('post')) {
                $model->agendamento         = $request->agendamento;
                $model->visita_leardi       = $request->visita_leardi;
                $model->visita_terceiros    = $request->visita_terceiros;
                $model->comentario          = $request->comentario;

                if ($request->visita_terceiros != null && $request->visita_terceiros == 1 && $tipo_negocio == 'V') {
                    $model->alerta = 1;
                }

                $model->saveOrFail();
                return redirect('pesquisa/concluido');

            }

            return view('site.interacao.faccq2_3dias', array('model'=>$model));

        } else {
            abort(404, 'Não conseguimos processar a solicitação ... ');
        }

    }


    public function atendimento10Dias(Request $request)
    {
        //$evt_id=0, $evt_code='', $resposta=''
        $evt_id = $request->evt_id;
        $evt_code = $request->evt_code;
        $resposta = $request->resposta;

        if (base64_encode($this->crypto->encrypt($evt_id)) == $evt_code) {
            // pega o evento de e-mail enviado ...
            $evt_email_enviado = EvtEmailEnviado::where('evt_email_enviado_id', $evt_id)->first();
            if ($evt_email_enviado == null) {
                abort(404);
            }

            $crmFac = CrmFac::where('fac_id', $evt_email_enviado->chave_id)->first();
            if ($crmFac == null) {
                $tipo_negocio = 'V';
            } else {
                $tipo_negocio = $crmFac->tipo_negocio;
            }
            if ($tipo_negocio == null || $tipo_negocio == '') {
                $tipo_negocio = 'V';
            }

            $model = EvtEmailFacCq2::where('evt_email_enviado_id', $evt_id)->first();
            if ($model == null) {
                $model = new EvtEmailFacCq2();
                $model->evt_email_enviado_id = $evt_id;
                $model->email_id = $evt_email_enviado['email_id'];
            }

            // esta parte sempre grava, porque o cliente pode clicar em outra opção ...
            $model->resposta = $resposta;
            if (($resposta == 'RUIM' || $resposta == 'SEM RETORNO') && $tipo_negocio == 'V') {
                $model->alerta = 1;
            } else {
                $model->alerta = 0;
            }

            $model->saveOrFail();

            if ($request->isMethod('post')) {
                $model->visita_leardi       = $request->visita_leardi;
                $model->visita_terceiros    = $request->visita_terceiros;
                $model->outro_profissional  = $request->outro_profissional;
                $model->comentario          = $request->comentario;

                if ($request->visita_terceiros != null && $request->visita_terceiros == 1 && $tipo_negocio == 'V') {
                    $model->alerta = 1;
                }

                if ($request->outro_profissional != null && $request->outro_profissional == 1 && $tipo_negocio == 'V') {
                    $model->alerta = 1;
                }

                $model->saveOrFail();
                return redirect('pesquisa/concluido');

            }

            return view('site.interacao.faccq2_10dias', array('model'=>$model));

        } else {
            abort(404, 'Não conseguimos processar a solicitação ... ');
        }

    }

    public function atendimento30Dias(Request $request)
    {
        //$evt_id=0, $evt_code='', $resposta=''
        $evt_id = $request->evt_id;
        $evt_code = $request->evt_code;
        $resposta = $request->resposta;

        if (base64_encode($this->crypto->encrypt($evt_id)) == $evt_code) {
            // pega o evento de e-mail enviado ...
            $evt_email_enviado = EvtEmailEnviado::where('evt_email_enviado_id', $evt_id)->first();
            if ($evt_email_enviado == null) {
                abort(404);
            }

            $crmFac = CrmFac::where('fac_id', $evt_email_enviado->chave_id)->first();
            if ($crmFac == null) {
                $tipo_negocio = 'V';
            } else {
                $tipo_negocio = $crmFac->tipo_negocio;
            }
            if ($tipo_negocio == null || $tipo_negocio == '') {
                $tipo_negocio = 'V';
            }

            $model = EvtEmailFacCq2::where('evt_email_enviado_id', $evt_id)->first();
            if ($model == null) {
                $model = new EvtEmailFacCq2();
                $model->evt_email_enviado_id = $evt_id;
                $model->email_id = $evt_email_enviado['email_id'];
            }

            // esta parte sempre grava, porque o cliente pode clicar em outra opção ...
            $model->resposta = $resposta;
            if (($resposta == 'RUIM' || $resposta == 'SEM RETORNO') && $tipo_negocio == 'V') {
                $model->alerta = 1;
            } else {
                $model->alerta = 0;
            }

            $model->saveOrFail();

            if ($request->isMethod('post')) {
                $model->visita_leardi       = $request->visita_leardi;
                $model->visita_terceiros    = $request->visita_terceiros;
                $model->outro_profissional  = $request->outro_profissional;
                $model->comentario          = $request->comentario;

                if ($request->visita_terceiros != null && $request->visita_terceiros == 1 && $tipo_negocio == 'V') {
                    $model->alerta = 1;
                }

                if ($request->outro_profissional != null && $request->outro_profissional == 1 && $tipo_negocio == 'V') {
                    $model->alerta = 1;
                }

                $model->saveOrFail();
                return redirect('pesquisa/concluido');

            }

            return view('site.interacao.faccq2_30dias', array('model'=>$model));

        } else {
            abort(404, 'Não conseguimos processar a solicitação ... ');
        }

    }



    public function obrigado()
    {
        return view('site.interacao.obrigado');
    }

    /**
     * Exibe a foto do profissional
     * @param Request $request
     * @return view
     */
    public function logo(Request $request) {
        //$evt_id=0, $evt_code=''
        $evt_id = $request->evt_id;
        $evt_code = $request->evt_code;

        if (base64_encode($this->crypto->encrypt($evt_id)) == $evt_code) {
            EvtEmailEnviado::where('evt_email_enviado_id', $evt_id)->update(['visualizado' => 1, 'data_hora_visualizacao' => date('Y-m-d H:i:s')]);
        }
        return view('site.interacao._logo_rodape');
    }

}
