<?php

namespace App\Providers;

//use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Bdi\Observers\ContatoObserver;
use App\Site\Contato;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // add html helper to all views ... @by Marcio Nido
        // View::share('html', new \App\Http\Components\Html);

        // observer for the contato model
        Contato::observe(ContatoObserver::class);
        
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
