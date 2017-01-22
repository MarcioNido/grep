<?php

namespace App;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Monolog\Logger;

class Tracker
{
    private $log;

    public function __construct(Logger $log)
    {
        $this->log = $log;
    }

    public function register($action, $info=[])
    {

        $fixed_info = [
            'ip' => $_SERVER['REMOTE_ADDR'] ?: '',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'],
            'session' => session()->getId(),
            'url' => request()->getUri(),
            'method' => request()->getMethod(),
            'guest' => Auth::guest(),
            'user' => Auth::id(),
            'route' => Route::currentRouteName(),
            'action' => Route::current()->getActionName(),
            'parameters' => Route::current()->parameters(),
            'user_data' => request()->all(),
        ];

        $info = array_merge($fixed_info, $info);
        $this->log->info($action, $info);
    }

}