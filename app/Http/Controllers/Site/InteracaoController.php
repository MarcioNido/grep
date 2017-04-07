<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Site\Interacao;

//use Illuminate\Http\Request;

// http://www.leardi.com.br/pesquisa/atendimento30dias/evt_id/1755699/evt_code/SGtPZjJWdlhDVy9pUWxZWkRnU0thdz09/resposta/BOM

class InteracaoController extends Controller
{
    public function index(Request $request)
    {
        $interacao = new Interacao();
        $interacao->response = $request->url();
        $interacao->save();
        return view('site.interacao.obrigado');
    }
}
