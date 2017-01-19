<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function edita(Request $request)
    {

        $user = User::find(Auth::id());
        if (! $user) {
            throw new \Exception("Usuário não encontrado ...", 404);
        }


        if ($request->isMethod('post')) {

            $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$user->id,
                'password' => 'min:6|confirmed|nullable',
            ]);


            $user->fill($request->all());
            if ($request->password && $request->password != '') {
                $user->password = bcrypt($request->password);
            } else {
                unset($user->password);
            }
            $user->saveOrFail();

            session()->flash('flash_message', 'Dados atualizados com sucesso!');
            return redirect('/area-restrita/index');

        }

        return view('site.area-restrita.dados-pessoais', ['user' => $user]);

    }


}