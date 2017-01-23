<?php
/**
 * Created by PhpStorm.
 * User: marcionido
 * Date: 2017-01-22
 * Time: 6:47 PM
 */

namespace App;


use Illuminate\Support\Facades\Cookie;
use Closure;

class Lander
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if (! $request->session()->has('lander')) {
            if (Cookie::get('lander')) {
                \App::make('\App\Tracker')->register('Lander Return');
            } else {
                \App::make('\App\Tracker')->register('Lander New');
            }
            Cookie::queue('lander', $request->url());
            $request->session()->set('lander', $request->url());
        }
        return $response;
    }
}