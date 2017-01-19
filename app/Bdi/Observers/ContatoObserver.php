<?php

namespace App\Bdi\Observers;

use App\Bdi\Jobs\ContatoMaisInformacoesFacJob;
use App\Site\Contato;
use App\Bdi\Jobs\ContatoMaisInformacoesEmailJob;
use Carbon\Carbon;
/**
 * Class ContatoObserver
 * This class will listen to new contacts from the site and trigger the BDI specific jobs
 * like send email to the agency, create the pre-atendimento fac, etc ...
 *
 * This way, we keep the BDI specific stuff apart from the grep code ...
 */
class ContatoObserver
{
    /**
     * Listen to the created event of Contato Model
     * @param Contato $contato
     */
    public function created(Contato $contato)
    {
        $jobEmail = (new ContatoMaisInformacoesEmailJob($contato))->onQueue('main');
        dispatch($jobEmail);

        $jobFac = (new ContatoMaisInformacoesFacJob($contato))->onQueue('main');
        dispatch($jobFac);
    }

}