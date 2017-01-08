<?php

namespace App\Providers;

use Collective\Html\FormFacade;
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
        // observer for the contato model
        Contato::observe(ContatoObserver::class);

        // form components
        FormFacade::component('activeText', 'components.form.activeText', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('activeTextArea', 'components.form.activeTextArea', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('activeDropDownList', 'components.form.activeDropDownList', ['label', 'name', 'value'=>null, 'data'=>[], 'attributes'=>[]]);
        FormFacade::component('activeRadio', 'components.form.activeRadio', ['label', 'name', 'value', 'checked_value'=>null, 'attributes'=>[]]);
        FormFacade::component('errors', 'components.form.errors', []);
        FormFacade::component('flash_message', 'components.form.flashMessage', []);

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
