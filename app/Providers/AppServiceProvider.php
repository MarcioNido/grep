<?php

namespace App\Providers;

use App\Bdi\Observers\CadastroImovelObserver;
use App\Bdi\Observers\FranqueadoObserver;
use App\Bdi\Observers\TrabalheConoscoObserver;
use App\Site\CadImovel;
use App\Site\ContatoFranqueado;
use App\Site\TrabalheConosco;
use Collective\Html\FormFacade;
use Illuminate\Support\ServiceProvider;
use App\Bdi\Observers\ContatoObserver;
use App\Site\Contato;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use App\Tracker;

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

        // observer for the cadimovel model
        CadImovel::observe(CadastroImovelObserver::class);

        // observer for the franqueado model
        ContatoFranqueado::observe(FranqueadoObserver::class);

        // observer for the trabalhe conosco model
        TrabalheConosco::observe(TrabalheConoscoObserver::class);

        // form components
        FormFacade::component('activeText', 'components.form.activeText', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('activePassword', 'components.form.activePassword', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('activeTextArea', 'components.form.activeTextArea', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('activeDropDownList', 'components.form.activeDropDownList', ['label', 'name', 'value'=>null, 'data'=>[], 'attributes'=>[]]);
        FormFacade::component('activeRadio', 'components.form.activeRadio', ['label', 'name', 'value', 'checked_value'=>null, 'attributes'=>[]]);
        FormFacade::component('activeCheckBox', 'components.form.activeCheckBox', ['label', 'name', 'checked'=>0, 'attributes'=>[]]);
        FormFacade::component('activeFile', 'components.form.activeFile', ['label', 'name', 'value'=>null, 'attributes'=>[]]);
        FormFacade::component('errors', 'components.form.errors', []);
        FormFacade::component('flash_message', 'components.form.flashMessage', []);
        FormFacade::component('breadcrumbs', 'components.form.breadcrumbs', ['breadcrumbs']);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Tracker Service
        $this->app->singleton('\App\Tracker', function() {
            $logger = new Logger('grep_tracker');
            $output = "%datetime%|%level_name%|%message%|%context%|%extra%\n";
            $formatter = new LineFormatter($output);
            $stream = new StreamHandler(storage_path("/logs/grepdata.log"));
            $stream->setFormatter($formatter);
            $logger->pushHandler($stream);
            return new Tracker($logger);
        });

    }
}
