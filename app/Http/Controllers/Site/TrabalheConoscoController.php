<?php

namespace App\Http\Controllers\Site;

use App\Http\Components\CHtml;
use App\Http\Controllers\Controller;
use App\Site\CadImovel;
use App\Site\Localidade;
use App\Site\NotificacaoImovel;
use App\Site\TrabalheConosco;
use App\User;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DropDownTool;
use App\Site\Cep;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

class TrabalheConoscoController extends Controller
{

    public function edita(Request $request)
    {
        $origem = 'SITE';
        if (isset($request->origem)) {
            $origem = mb_convert_case($request->origem, MB_CASE_UPPER);
        }

        if (Auth::guest()) {
            $trabalhe = new TrabalheConosco();
        } else {
            $trabalhe = TrabalheConosco::where(['user_id' => Auth::id()])->first();
            if (! $trabalhe) {
                $trabalhe = new TrabalheConosco();
                $trabalhe->user_id = Auth::id();
                $trabalhe->nome = Auth::user()->name;
                $trabalhe->email = Auth::user()->email;
            }
        }

        if ($request->isMethod('post')) {

            $trabalhe->fill($request->all());
            $trabalhe->nascimento = CHtml::dateUs($trabalhe->nascimento) ?: null;
            $trabalhe->unidade = (int) $trabalhe->unidade;
            $trabalhe->bloco = (int) $trabalhe->bloco;
            $trabalhe->origem = $origem;
            $trabalhe->saveOrFail();

            if (Auth::guest()) {
                if ($user_id = $this->addUser($trabalhe)) {
                    $trabalhe->user_id = $user_id;
                    $trabalhe->save();
                    return redirect('/area-restrita/index');
                } else {
                    return redirect('/');
                }
            } else {
                return redirect('/area-restrita/index');
            }

            // se não conseguir exibe mensagem de cadastro realizado e vai para a home


        }

        $trabalhe->nascimento = CHtml::dateBr($trabalhe->nascimento);

        return view('site.area-restrita.trabalhe-conosco', ['trabalhe' => $trabalhe]);

    }

    protected function addUser($trabalhe)
    {
        $user = new User();
        $user->name = $trabalhe->nome;
        $user->email = $trabalhe->email;
        $user->area_code = $trabalhe->ddd1;
        $user->phone = $trabalhe->telefone1;
        $user->password = Hash::make(str_random(10));
        try {
            $user->save();
            Auth::login($user);
            return $user->id;
        } catch (\Exception $e) {
            return false;
        }
    }


}