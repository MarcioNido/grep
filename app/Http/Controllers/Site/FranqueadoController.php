<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Site\ContatoFranqueado;

use Illuminate\Http\Request;

class FranqueadoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the Seja um Franqueado Page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.franqueado.seja_um_franqueado');
    }

    public function storeContato(Request $request)
    {
        $contato = new ContatoFranqueado();
        $contato->nome = $request['nome'];
        $contato->email = $request['email'];
        $contato->ddd = $request['ddd'];
        $contato->telefone = $request['telefone'];
        $contato->mensagem = $request['mensagem'];
        $contato->envio_ofertas = $request['envio_ofertas'];
        $contato->saveOrFail();
        echo json_encode(['status' => 'ok']);
    }


}
