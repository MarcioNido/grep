<?php
/**
 * Created by PhpStorm.
 * User: marcionido
 * Date: 2017-01-22
 * Time: 6:47 PM
 */

namespace App;

use App\Site\Agencia;
use Closure;

class SubDomain
{
    public function handle($request, Closure $next)
    {
        /** @var Agencia $unidade */
        $unidade = Agencia::where('subdomain', $request->unidade)->orWhere('agencia_sigla', $request->unidade)->first();
        if ($unidade == null) {
            session(['unidade' => null]);
        } else {
            session(['unidade' => $unidade]);
        }
        return $next($request);
    }
}