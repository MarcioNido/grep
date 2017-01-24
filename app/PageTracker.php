<?php
/**
 * Created by PhpStorm.
 * User: marcionido
 * Date: 2017-01-22
 * Time: 6:47 PM
 */

namespace App;

use Closure;

class PageTracker
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        \App::make('\App\Tracker')->register('PageTracker', ['responseCode' => $response->status()]);
    }
}