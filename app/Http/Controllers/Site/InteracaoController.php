<?php

namespace App\Http\Controllers\Site;
use App\Bdi\CrmFac;
use App\Bdi\EvtEmailFacCq2;
use App\Crypto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site\Interacao;

//use Illuminate\Http\Request;

// http://www.leardi.com.br/pesquisa/atendimento30dias/evt_id/1755699/evt_code/SGtPZjJWdlhDVy9pUWxZWkRnU0thdz09/resposta/BOM

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

    public function atendimento3Dias($evt_id=0, $evt_code='', $resposta='')
    {
//        if (base64_encode($this->crypto->encrypt($evt_id)) == $evt_code) {
//            // pega o evento de e-mail enviado ...
//            $evt_email_enviado = EvtEmailFacCq2::where('evt_email_enviado_id', $evt_id)->first();
//            if ($evt_email_enviado == null) {
//                abort(404);
//            }
//
//            $crmFac = CrmFac::where('fac_id', $evt_email_enviado->chave_id)->first();
//            if ($crmFac == null) {
//                $tipo_negocio = 'V';
//            } else {
//                $tipo_negocio = $crmFac->tipo_negocio;
//            }
//            if ($tipo_negocio == null || $tipo_negocio == '') {
//                $tipo_negocio = 'V';
//            }
//
//            $model = EvtEmailFacCq2::model()->findByPk($evt_id);
//            if ($model == null) {
//                $model = new EvtEmailFacCq2();
//                $model->evt_email_enviado_id = $evt_id;
//                $model->email_id = $evt_email_enviado['email_id'];
//            }
//
//            // esta parte sempre grava, porque o cliente pode clicar em outra opção ...
//            $model->resposta = $resposta;
//            if (($resposta == 'RUIM' || $resposta == 'SEM RETORNO') && $tipo_negocio == 'V') {
//                $model->alerta = 1;
//            } else {
//                $model->alerta = 0;
//            }
//
//            if (! $model->save()) {
//                // @todo: tratar este erro ...
//                throw new CHttpException(500, print_r($model->errors, true));
//            }
//
//
//            if (isset($_POST['EvtEmailFacCq2'])) {
//                $form = $_POST['EvtEmailFacCq2'];
//                $model->agendamento = $form['agendamento'];
//                $model->visita_leardi = $form['visita_leardi'];
//                $model->visita_terceiros = $form['visita_terceiros'];
//                $model->comentario = $form['comentario'];
//
//                if ($form['visita_terceiros'] != null && $form['visita_terceiros'] == 1 && $tipo_negocio == 'V') {
//                    $model->alerta = 1;
//                }
//
//                if ($model->save()) {
//                    $this->redirect(array('facCq2Concluido'));
//                }
//
//            }
//
//            // insere ou atualiza o estágio cq1 da tabela de eventos ...
//            $this->render('faccq2_3dias', array('model'=>$model));
//
//        } else {
//            throw new CHttpException(500, 'Não conseguimos processar a solicitação ... ');
//        }

    }

}
